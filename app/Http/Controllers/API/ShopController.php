<?php

namespace App\Http\Controllers\API;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Size;

class ShopController extends Controller
{

    public function appHome()
    {
        $data['categories'] = Category::with('products.photos', 'products.items.color', 'products.items.size')->get();

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

    public function sizes()
    {
        $sizes = Size::get();

        return response()->json(compact('sizes'));
    }

    public function colors()
    {
        $colors = Color::get();

        return response()->json(compact('colors'));
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

        if ($request->filled('price_from') && $request->filled('price_to')) {
            $productsQuery->whereHas('items', function ($query) {
                $query->whereBetween('price', [request('price_from'), request('price_to')]);
            });
        }

        $products = $productsQuery->paginate($perPage);

        return response()->json(compact('products'));
    }

    // Cart
    public function toggleCart()
    {
        $data['user'] = auth('api')->user();
        $item = $data['user']->cart()->where('item_id', request('item_id'))->first();
        if ($item) {
            $data['user']->cart()->where('item_id', request('item_id'))->delete();
        } else {
            $data['user']->cart()->create([
                'item_id' => request('item_id'),
                'quantity' => request('quantity'),
            ]);
        }

        $data['user']->load('userable');
        $data['cart'] = $data['user']->cart()->with('item.mainProduct', 'item.size', 'item.color')->get();

        return response()->json($data);
    }

    public function updateCart()
    {
        $data['user'] = auth('api')->user();
        $item = $data['user']->cart()->where('item_id', request('item_id'))->first();
        if ($item) {
            $data['user']->cart()->where('item_id', request('item_id'))->update([
                'quantity' => request('quantity')
            ]);
        }

        $data['user']->load('userable');
        $data['cart'] = $data['user']->cart()->with('item.mainProduct', 'item.size', 'item.color')->get();

        return response()->json($data);
    }

    public function myCart()
    {
        $data['user'] = auth('api')->user();

        $data['user']->load('userable');
        $data['cart'] = $data['user']->cart()->with('item.mainProduct', 'item.size', 'item.color')->get();

        return response()->json($data);
    }

    // Wishlist
    public function toggleWishlist()
    {
        $data['user'] = auth('api')->user();
        $product = $data['user']->wishlist()->where('product_id', request('product_id'))->first();
        if ($product) {
            $data['user']->wishlist()->where('product_id', request('product_id'))->delete();
        } else {
            $data['user']->wishlist()->create([
                'product_id' => request('product_id'),
                'quantity' => request('quantity'),
            ]);
        }

        $data['user']->load('userable');
        $data['wishlist'] = $data['user']->wishlist()->with('product.items.mainProduct', 'product.items.size', 'product.items.color')->get();

        return response()->json($data);
    }

    public function myWishlist()
    {
        $data['user'] = auth('api')->user();


        $data['user']->load('userable');
        $data['wishlist'] = $data['user']->wishlist()->with('product.items.mainProduct', 'product.items.size', 'product.items.color')->get();

        return response()->json($data);
    }
}
