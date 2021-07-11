<?php

namespace App\Http\Controllers\API;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;

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
        if ($data['product']) {
            $sizes = $data['product']->items()->pluck('size_id')->toArray();
            $data['productSizes'] = Size::whereIn('id', $sizes)->get();

            $colors = $data['product']->items()->pluck('color_id')->toArray();
            $data['productColors'] = Color::whereIn('id', $colors)->get();
        }

        return response()->json($data);
    }



    public function categories()
    {
        $categories = Category::get();

        return response()->json(compact('categories'));
    }

    public function products(Request $request)
    {

        $perPage = request()->filled('per_page') ? request('per_page') : 9;

        $productsQuery = Product::active()->with('photos', 'items.color', 'items.size');

        if ($request->filled('sort') == 'date') {
            $productsQuery->orderByTranslation('created_at', 'desc');
        } elseif ($request->filled('sort') == 'title') {
            $productsQuery->orderByTranslation('title');
        } else {
            $productsQuery->orderByTranslation('title');
        }


        if ($request->filled('title')) {
            $productsQuery->whereTranslationLike('title', '%' . request('title') . '%');
        }

        if ($request->filled('category_id')) {
            $productsQuery->where('category_id', request('category_id'));
        }

        if ($request->filled('size_id')) {
            $productsQuery->whereHas('items', function ($query) {
                $query->where('size_id', request('size_id'));
            });
        }
        if ($request->filled('color_id')) {
            $productsQuery->whereHas('items', function ($query) {
                $query->where('color_id', request('color_id'));
            });
        }

        $products = $productsQuery->paginate($perPage);

        return response()->json(compact('products'));
    }
}
