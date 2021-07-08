<?php

namespace App\Http\Controllers\API;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\Meta;
use App\Models\Page;
use App\Models\Trip;
use App\Models\User;
use App\Models\Brand;
use App\Models\Color;
use App\Models\State;
use App\Models\Driver;
use App\Models\Option;
use App\Models\Reason;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Category;
use App\Models\AppFeature;
use App\Models\Newsletter;
use App\Models\SocialLink;
use App\Models\FaqCategory;
use App\Models\Information;
use App\Models\VehicleType;
use App\Models\DonationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class ShopController extends Controller
{


    public function appHome()
    {
        $data['categories'] = Category::with(['products' => function ($query) {
            $query->with('photos', 'items')->limit(1);
        }])->get();

        return response()->json($data);
    }

    public function categoryProducts($category)
    {
        $data['category_products'] = Category::with('products.photos', 'products.items')->find($category);

        return response()->json($data);
    }
}
