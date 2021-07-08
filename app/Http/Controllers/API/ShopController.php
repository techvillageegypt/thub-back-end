<?php

namespace App\Http\Controllers\API;


use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ShopController extends Controller
{


    public function appHome()
    {
        $data['categories'] = Category::with(['products' => function ($query) {
            $query->with('photos', 'items')->limit(10);
        }])->get();

        return response()->json($data);
    }

    public function categoryProducts($category)
    {
        $data['category_products'] = Category::with('products.photos', 'products.items.color', 'products.items.size')->find($category);

        return response()->json($data);
    }

    public function product($id)
    {
        $data['product'] = Product::with('photos', 'items.color', 'items.size')->find($id);

        return response()->json($data);
    }
}
