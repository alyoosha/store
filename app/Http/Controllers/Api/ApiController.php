<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 25.02.2021
 * Time: 12:53
 */

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ApiController
{
    private function error($message, $input = null) {
        return ['error' => true, 'message' => $message, 'input' => $input];
    }

    private function success($data) {
        return ['error' => false, 'data' => $data];
    }

    public function makeOrder(Request $request) {
        $data = $request->all();

        if($request->isMethod('post') && isset($data['products'], $data['is-mail'], $data['order-form-addr'])) {

            $orderNum = sprintf('%04d', 1);
            $lastOrder = DB::table('orders')->orderByDesc('id')->first();

            if(!$data['is-mail']) {
                $data['user-address'] = null;
                $data['user-phone-number'] = null;
                $data['user-post-code'] = null;
            }
            else {
                if(empty($data['user-name']) && !preg_match('/[a-zA-zа-яА-ЯёЁ\s]{3,}/', $data['user-name'], $matches)) {
                    return $this->error(__('validation.name', ['attribute' =>'Имя']), 'user-name');
                }

                if(empty($data['user-address']) && !preg_match('/[a-zA-zа-яА-ЯёЁ\s-\,\.]{3,}/', $data['user-address'], $matches)) {
                    return $this->error(__('validation.address', ['attribute' =>'Адрес']), 'user-address');
                }

                if(empty($data['user-phone-number']) && !preg_match('/[0-9]{11,}/g', $data['user-phone-number'], $matches)) {
                    return $this->error(__('validation.phone', ['attribute' => 'Телефон']), 'user-phone-number');
                }

                if(empty($data['user-post-code']) && !preg_match('/[0-9]{6}/', $data['user-post-code'], $matches)) {
                    return $this->error(__('validation.postcode', ['attribute' => 'Почтовый индекс']), 'user-post-code');
                }
            }

            if($lastOrder) {
                $orderNum = sprintf('%04d', $lastOrder->number_order + 1);
            }

            try {
                json_decode($data['products']);
            }
            catch (\Exception $exception) {
                return $this->error('Что-то пошло не так. Попробуйте позже.');
            }

            try {
                $order = Order::create(
                    [
                        'full_name' => $data['user-name'],
                        'postcode' => $data['user-post-code'],
                        'address' => $data['user-address'],
                        'address_delivery' => $data['order-form-addr'],
                        'phone' => $data['user-phone-number'],
                        'number_order' => $orderNum,
                        'products' => $data['products']
                    ]
                );

                $order->is_mail = (int) $data['is-mail'];

                return $this->success($order);
            }
            catch (QueryException $exception) {
                return $this->error('Что-то пошло не так. Попробуйте позже.');
            }
        }
        else {
            return $this->error('Что-то пошло не так. Попробуйте позже.');
        }
    }
}