<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 18.02.2021
 * Time: 13:25
 */

namespace App\Traits;


use Illuminate\Support\Facades\DB;

trait VoyagerTrait
{
    public function getFeatures() {
        $params = DB::table('types')
            ->selectRaw('"type_id" as "column", GROUP_CONCAT(id ORDER BY id) as id, GROUP_CONCAT(name ORDER BY id SEPARATOR "|") as name')
            ->union(DB::table('packages')
                ->selectRaw('"package_id" as "column", GROUP_CONCAT(id ORDER BY id) as id, GROUP_CONCAT(name ORDER BY id SEPARATOR "|") as name')
            )
            ->union(DB::table('names')
                ->selectRaw('"name_id" as "column", GROUP_CONCAT(id ORDER BY id) as id, GROUP_CONCAT(name ORDER BY id SEPARATOR "|") as name')
            )
            ->union(DB::table('colors')
                ->selectRaw('"color_id" as "column", GROUP_CONCAT(id ORDER BY id) as id, GROUP_CONCAT(name  ORDER BY id SEPARATOR "|") as name')
            )->get();

        $params->map(function ($item) {
            if(!is_null($item->id)) {
                $ids = explode(',', $item->id);
            }
            if(!is_null($item->name)) {
                $names = explode('|', $item->name);
            }

            return $item->names = collect(array_combine($ids, $names));
        });

        $params = $params->pluck(null, 'column');

        return $params;
    }

//    public function getProducts($data) {
//        $ids = collect([]);
//        $prods = collect([]);
//
//
//        dd($data);
//        foreach ($data as $item) {
//            if ($products = $item->products) {
//                try {
//                    $prods->push(collect(json_decode($products, true))->pluck(null, 'id'));
//                    $ids->push(collect(json_decode($products, true))->pluck(null, 'id')->keys());
//                } catch (\Exception $e) {
//                    return $products = null;
//                }
//            }
//
//        }
//
//        $ids = $ids->flatten()->unique();
//
//        $products = DB::table('products')
//            ->select([
//                'products.id as id',
//                'names.name as name',
//                'types.name as type_name',
//                'packages.name as package_name',
//                'colors.name as color_name'
//            ])
//            ->leftJoin('names', 'products.name_id', '=', 'names.id')
//            ->leftJoin('types', 'products.type_id', '=', 'types.id')
//            ->leftJoin('packages', 'products.package_id', '=', 'packages.id')
//            ->leftJoin('colors', 'products.color_id', '=', 'colors.id')
//            ->whereIn('products.id', $ids)
//            ->get()
//            ->pluck(null, 'id');
//
//    }
}