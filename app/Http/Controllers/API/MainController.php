<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationPusher;
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
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use OneSignal;

class MainController extends Controller
{
    public function test()
    {


        OneSignal::sendNotificationToAll(
            "Some Message",
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null,
            'ionsgsdngsdoinfweonfweonfserofnesefoiei'
        );

        return ('Done');
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





    ##########################################################################

    // Pages

    public function landing_page()
    {
        $data['slider'] = Slider::active()->orderBy('in_order_to')->get();
        $data['latest_products'] = Product::with('category', 'photos', 'items.color', 'items.size')->latest()->limit(12)->get();
        $data['donation_types'] = DonationType::get();

        // $blogs = Blog::latest()->limit(3)->get();
        // $appFeatures = AppFeature::get();

        return response()->json($data);
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
        // $data['description']    = $informations->where('id', 4)->first()->value;

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
        $blogs = Blog::latest()->paginate(8);

        return response()->json(compact('blogs'));
    }

    public function blog($id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json(compact('blog'));
    }

    // public function faqs()
    // {
    //     $data['faqCategories'] = FaqCategory::orderByTranslation('name')->with('faqs')->get();

    //     return response()->json($data);
    // }
}
