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

class MainController extends Controller
{
    public function test()
    {
        return ('test home');
    }

    ##########################################################################

    // General

    public function states()
    {
        $states = State::get();

        return response()->json(compact('states'));
    }

    public function donation_types()
    {
        $donation_types = DonationType::get();

        return response()->json(compact('donation_types'));
    }

    public function options()
    {
        $options = Option::first();

        return response()->json(compact('options'));
    }









    public function brands()
    {
        $brands = Brand::get();

        return response()->json(compact('brands'));
    }

    public function colors()
    {
        $colors = Color::get();

        return response()->json(compact('colors'));
    }

    public function categories(Request $request)
    {
        $categories = Category::where('service_id', $request->service_id)->active()->get();

        return response()->json(compact('categories'));
    }


    ##########################################################################

    // Pages

    public function landing_page()
    {
        $slider = Slider::active()->orderBy('in_order_to')->get();
        $services = Service::active()->get();
        $blogs = Blog::latest()->limit(3)->get();
        $appFeatures = AppFeature::get();

        return response()->json(compact('slider', 'services', 'blogs', 'appFeatures'));
    }

    public function pages($id)
    {
        $page = Page::with('paragraph', 'image')->find($id);

        return response()->json(compact('page'));
    }

    public function informations()
    {
        $informations = Information::get();

        $data['phone']          = $informations->where('id', 1)->first()->value;
        $data['email']          = $informations->where('id', 2)->first()->value;
        $data['address']        = $informations->where('id', 3)->first()->value;
        $data['description']    = $informations->where('id', 4)->first()->value;

        $social = SocialLink::get();

        $data['facebook']   = $social->where('id', 1)->first()->link;
        $data['twitter']    = $social->where('id', 2)->first()->link;
        $data['instagram']  = $social->where('id', 3)->first()->link;
        $data['linkedIn']   = $social->where('id', 4)->first()->link;

        return response()->json($data);
    }

    public function send_contact_message(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|min:3|max:191',
            'email'     => 'required|email|min:3|max:191',
            'phone'     => 'required',
            'subject'   => 'required|string|min:3|max:191',
            'message'   => 'required|string|min:3',
        ]);
        Contact::create($validated);

        return response()->json(['msg' => 'success']);
    }

    public function newsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|min:3|max:191|unique:newsletters,email',
        ]);
        Newsletter::create($validated);

        return response()->json(['msg' => 'success']);
    }

    public function metas()
    {
        $metas = Meta::get();

        return response()->json(compact('metas'));
    }

    public function blogs()
    {
        $blogs = Blog::latest()->get();

        return response()->json(compact('blogs'));
    }

    public function blog($id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json(compact('blog'));
    }

    public function faqs()
    {
        $data['faqCategories'] = FaqCategory::orderByTranslation('name')->with('faqs')->get();

        return response()->json($data);
    }
}