<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Size;
use App\Models\Color;
use App\Models\Order;
use App\Models\State;
use App\Models\Product;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Events\NotificationPusher;
use App\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Builder;

class ShopController extends Controller
{


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

    public function appHome()
    {

        // $category = Category::find(request('category_id'));

        // $categoryIDs = $category->children->pluck('id');

        // $data['products'] = Product::active()->with('photos', 'items.color', 'items.size')->whereIn('category_id', $categoryIDs)->get();


        // $data['products'] = Product::active()->with('photos', 'items.color', 'items.size')->where('category_id', request('category_id'))->get();




        $data['categories'] = Category::parent()->with('children.products.photos', 'children.products.items.color', 'children.products.items.size')->get();

        return response()->json($data);
    }


    public function categoryProducts($category)
    {

        $categoryData = Category::find($category);

        if ($categoryData->parent_id == null && $categoryData->has('children')) {
            $categoryIDs = $categoryData->children->pluck('id');
            $data['category_products'] = Product::active()->with('photos', 'items.color', 'items.size')->whereIn('category_id', $categoryIDs)->get();
        } else {
            $data['category_products'] = Product::active()->with('photos', 'items.color', 'items.size')->where('category_id', $category)->get();
        }


        return response()->json($data);
    }

    public function categories()
    {
        $categories = Category::parent()->with('children')->get();

        return response()->json(compact('categories'));
    }

    public function products(Request $request)
    {

        $perPage = request()->filled('per_page') ? request('per_page') : 9;

        $productsQuery = Product::active()->with('photos', 'items.color', 'items.size');

        if ($request->filled('sort')) {
            switch ($request->sort) {

                case 'title':
                    $productsQuery->orderByTranslation('title');
                    break;

                case 'date':
                    $productsQuery->orderBy('created_at', 'desc');
                    break;

                case 'lower_price':
                    $productsQuery->orderBy('min_price');
                    break;

                case 'higher_price':
                    $productsQuery->orderBy('min_price', 'desc');
                    break;

                default:
                    break;
            }
        } else {
            $productsQuery->orderByTranslation('title');
        }


        if ($request->filled('title')) {
            $productsQuery->whereTranslationLike('title', '%' . request('title') . '%');
        }

        if ($request->filled('category_id')) {

            $category = Category::find(request('category_id'));
            if ($category->parent_id == null && $category->has('children')) {
                $categoryIDs = $category->children->pluck('id');

                $productsQuery->whereIn('category_id', $categoryIDs);
            } else {
                $productsQuery->where('category_id', request('category_id'));
            }
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

        $data['products'] = $productsQuery->paginate($perPage);

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


        $products = Product::with('photos')->where('category_id', $data['product']->category_id)
            ->where('id', '!=', $data['product']->id)
            ->limit(20)
            ->get();
        if ($products->count() > 1) {
            $data['related_products'] = $products->random($products->count() - 1);
            $data['related_products']->all();
        } else {
            $data['related_products'] = Product::with('photos')->limit(20)->get()->random(Product::with('photos')->limit(20)->get()->count() - 1);
            $data['related_products']->all();
        }

        return response()->json($data);
    }

    public function randomProducts()
    {
        $allProducts = Product::with('photos')->limit(20)->get();
        $data['random_products'] = $allProducts->random($allProducts->count() - 1);

        return response()->json($data);
    }

    // All Products max Price For max Price Filtering
    public function maxPrice()
    {
        $products = Product::active()->get();

        $prices = collect();
        foreach ($products as $product) {
            $prices->push($product->items()->max('price'));
        }
        $prices->all();

        $maxPrice = $prices->max();

        return response()->json(compact('maxPrice'));
    }

    // Cart
    public function toggleCart()
    {
        request()->validate(['item_id' => 'exists:product_items,id']);
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
        $data['cart'] = $data['user']->cart()->with('item.mainProduct.photos', 'item.size', 'item.color')->get();

        $data += $this->calcTotal($data['cart']);

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
        $data['cart'] = $data['user']->cart()->with('item.mainProduct.photos', 'item.size', 'item.color')->get();

        $data += $this->calcTotal($data['cart']);

        return response()->json($data);
    }

    public function myCart()
    {
        $data['user'] = auth('api')->user();

        $data['user']->load('userable');
        $data['cart'] = $data['user']->cart()->with('item.mainProduct.photos', 'item.size', 'item.color')->get();

        $data += $this->calcTotal($data['cart']);

        return response()->json($data);
    }

    // Wishlist
    public function toggleWishlist()
    {
        request()->validate(['product_id' => 'exists:products,id']);
        $data['user'] = auth('api')->user();
        $wishlistProduct = $data['user']->wishlist()->where('product_id', request('product_id'))->first();
        if ($wishlistProduct) {
            $data['user']->wishlist()->where('product_id', request('product_id'))->delete();
        } else {
            $data['user']->wishlist()->create([
                'product_id' => request('product_id'),
                'quantity' => request('quantity'),
            ]);
        }
        $data['product'] = Product::findOrFail(request('product_id'));
        $data['user']->load('userable');
        $data['wishlist'] = $data['user']->wishlist()->with('product.photos', 'product.items.size', 'product.items.color')->get();

        return response()->json($data);
    }

    public function myWishlist()
    {
        $data['user'] = auth('api')->user();


        $data['user']->load('userable');
        $data['wishlist'] = $data['user']->wishlist()->with('product.photos', 'product.items.size', 'product.items.color')->get();

        return response()->json($data);
    }

    public function checkout()
    {
        $validated = request()->validate([
            'name'              => 'required|string|max:191',
            'address'           => 'required|string|max:191',
            'state_id'          => 'required|exists:states,id',
            'housing_type'      => 'required|in:1,2',
            'house_number'      => 'required_if:housing_type,1|numeric',
            'building_number'   => 'required_if:housing_type,2|numeric',
            'apartment_number'  => 'required_if:housing_type,2|numeric',
            'payment_method'    => 'required|numeric',
        ]);

        $user = auth('api')->user();

        $validated['user_id'] = $user->id;
        $validated['state_id'] = request('state_id');
        $validated['state'] = State::find(request('state_id'))->name;
        $validated['phone'] = $user->phone;

        $data['order'] = Order::create($validated);

        $userCart = $user->cart;

        foreach ($userCart as $cart) {
            $data['order']->items()->create([
                'item_id' => $cart->item_id,
                'title' => $cart->item->mainProduct->title,
                'color' => $cart->item->color->hex,
                'size' => $cart->item->size->name,
                'price' => $cart->item->final_price,
                'quantity' => $cart->quantity,
            ]);
        }

        $data += $this->calcTotal($userCart);

        $data['order']->update(['total' => $data['total']]);
        foreach ($userCart as $item) {
            $item->delete();
        }

        $data['order']->load('items');

        // Fire & save Notification
        Notification::create([
            'user_id' => $user->id,
            'type' => 'checkout',
            'en' => [
                'text' => 'Your order created successfuly with order id : ' . $data['order']->id,
            ],
            'ar' => [
                'text' => 'تم تنفيذ الطلب بنجاح برقم : ' . $data['order']->id,
            ]

        ]);

        event(new NotificationPusher([
            'type'      => 'checkout',
            'send_to'   => $user->id,
            'data'      => $data,
            'text'      => __('lang.checkout_notification') . $data['order']->id,
        ]));

        return response()->json($data);
    }


    public function myOrders()
    {
        $user = auth('api')->user();

        $data['orders'] = $user->orders()->with('items')->get();

        return response()->json($data);
    }











    ############################################################################
    ################################### Helpers ################################
    ############################################################################


    protected function calcTotal($cartData)
    {
        $data['total'] = 0;
        $data['totalQuantity'] = 0;
        foreach ($cartData as $cart) {

            $itemPrice = $cart->item->final_price;
            $itemQuantity = $cart->quantity;
            $totalPrice = $itemPrice * $itemQuantity;
            $data['total'] += $totalPrice;
            $data['totalQuantity'] += $itemQuantity;
        }

        return $data;
    }
}
