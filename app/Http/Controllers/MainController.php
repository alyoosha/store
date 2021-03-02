<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 19.02.2021
 * Time: 14:23
 */

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\FreeSticker;
use App\Models\FreeStickersModal;
use App\Models\MainSlider;
use App\Models\ModalSlider;
use App\Models\Package;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request) {
        try {
            $cookie = json_decode($request->cookie(NAME_SESSION), true);
        }
        catch (\Exception $e) {
            $cookie = null;
        }

        $mainSlider = MainSlider::active()->get();
        $modalSlider = ModalSlider::isActive()->get()->pluck(null, 'id');

        $freeStickers['numbers'] = str_split(FreeSticker::find(1)->count);
        $freeStickers['count'] = FreeSticker::find(1)->count;

        $dataMap = FreeStickersModal::all();
        $products = Product::select(
            [
                'products.id as id',
                'types.id as type_id',
                'packages.id as package_id',
                'colors.id as color_id',
                'names.id as name_id',
                'products.type_id',
                'products.package_id',
                'products.name_id',
                'products.color_id',
                'types.name as type_name',
                'packages.name as package_name',
                'names.name as name',
                'colors.name as color_name',
                'products.images',
                'products.basic_price',
                'products.description',
            ]
        )
            ->leftJoin('types', 'types.id', 'products.type_id')
            ->leftJoin('packages', 'packages.id', 'products.package_id')
            ->leftJoin('names', 'names.id', 'products.name_id')
            ->leftJoin('colors', 'colors.id', 'products.color_id')
            ->orderBy('products.name_id')
            ->get();

        $products->map(function ($item) {
            if($item->images) {
                $images = json_decode($item->images);
                $imgs = [];

                array_walk($images, function($img) use (&$item, &$imgs) {
                    $arr = [];
                    $arr['image'] = asset('storage/' . $img);
                    $arr['type_id'] = $item->type_id;
                    $arr['package_id'] = $item->package_id;
                    $arr['name_id'] = $item->name_id;
                    $arr['color_id'] = $item->color_id;

                    $imgs[] = $arr;
                });

                $item->images = $imgs;
            }

            return $item;
        });

        $types = $products->groupBy('type_name');

        if(isset($types['Рамка'])) {
            $types['Рамка'] = $types['Рамка']->unique('name_id')->values();
        }

        $colors = $products->groupBy('name_id');

        $addresses = Address::isActive()->get();

        return view('page', compact(
            'mainSlider',
            'freeStickers',
            'dataMap',
            'products',
            'types',
            'colors',
            'addresses',
            'cookie',
            'modalSlider'
        ));
    }
}