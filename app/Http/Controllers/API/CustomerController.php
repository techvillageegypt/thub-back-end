<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Option;
use App\Models\Donation;
use App\Models\DriverRate;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DonationPhoto;
use App\Models\TypeOfDonation;
use App\Helpers\HelperFunctionTrait;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRate;

class CustomerController extends Controller
{
    use HelperFunctionTrait;

    public function test()
    {
        return ('test home');
    }

    ##################################################################
    # Dashboard
    ##################################################################

    public function update_information(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->validate([
            'name'              => 'required|string|max:191',
            'address'           => 'nullable|string|max:191',
            'state_id'          => 'nullable',
            'housing_type'      => 'required|in:1,2',
            'house_number'      => 'required_if:housing_type,1|numeric',
            'building_number'   => 'required_if:housing_type,2|numeric',
            'apartment_number'  => 'required_if:housing_type,2|numeric',
        ]);

        $user->userable()->update($data);
        $user->load('userable.state');

        return response()->json(compact('user'));
    }

    public function update_phone()
    {
        $user = auth('api')->user();

        $user->update(['verify_code' => $this->randomCode(4)]);

        return response()->json(['msg' => 'A confirmation code has been sent, check your inbox', 'code' => $user->verify_code]);
    }

    public function verify_phone(Request $request)
    {
        $request->validate([
            'phone'         => 'required|numeric|unique:users,phone',
            'verify_code'   => 'required|min:4|max:5'
        ]);

        $user = User::where(['phone' => auth()->user()->phone, 'verify_code'   => $request->verify_code])->first();

        if (empty($user)) {
            return response()->json(['msg' => 'Verify code is not correct'], 403);
        }

        $user->update(['phone' => $request->phone]);
        $user->load('userable.state');

        return response()->json(compact('user'));
    }

    public function wallet()
    {
        $user = auth('api')->user();
        $balance = $user->balance;

        return response()->json(compact('balance'));
    }



    //------------------------- End Dashboard --------------------------//



    ##################################################################
    # Donation
    ##################################################################

    public function donate()
    {
        $customer = User::with('userable')->find(auth('api')->id());

        if ($customer->type != 'customer') {
            return response()->json(['msg' => 'You Are Not Customer']);
        }

        // $data = request()->validate([
        //     'name'              => 'required|string|max:191',
        //     'address'           => 'required|string|max:191',
        //     'state_id'          => 'required|exists:states,id',
        //     'housing_type'      => 'required|in:1,2',
        //     'house_number'      => 'required_if:housing_type,1|numeric',
        //     'building_number'   => 'required_if:housing_type,2|numeric',
        //     'apartment_number'  => 'required_if:housing_type,2|numeric',
        //     'pickup_date'       => 'required|date',
        //     'photos'            => 'nullable|array',
        //     'photos.*'          => 'nullable|image|mimes:png,jpg,jpeg',
        //     'donation_types'    => 'nullable|array',
        //     'donation_types.*'  => 'nullable|exists:donation_types,id',
        // ]);

        $data = request()->validate([
            'name'                     => 'nullable|string|max:191',
            'address'                  => 'nullable|string|max:191',
            'lat'                      => 'nullable|string|max:191',
            'long'                     => 'nullable|string|max:191',
            'housing_type'             => 'nullable|in:1,2',
            'state_id'                 => 'nullable|exists:states,id',
            'house_number'             => 'nullable|numeric',
            'building_number'          => 'nullable|numeric',
            'apartment_number'         => 'nullable|numeric',
            'pickup_date'              => 'nullable|date',
            'customer_notes'           => 'nullable|string|max:191',
            'photos'                   => 'nullable|array',
            'photos.*'                 => 'nullable|image|mimes:png,jpg,jpeg',
            'donation_types'           => 'required|array',
            'donation_types.*'         => 'required|exists:donation_types,id',
        ]);

        $data['customer_id'] = $customer->userable->id;

        if ($customer->userable->donations->count() > 0) {
            $donation = Donation::create([
                'name'              => $data['name'] ?? null,
                'state_id'          => $data['state_id'] ?? null,
                'housing_type'      => $data['housing_type'] ?? null,
                'house_number'      => $data['house_number'] ?? null,
                'building_number'   => $data['building_number'] ?? null,
                'apartment_number'  => $data['apartment_number'] ?? null,
                'customer_id'       => $data['customer_id'] ?? null,
                'address'           => $data['address'] ?? null,
                'lat'               => $data['lat'] ?? null,
                'long'              => $data['long'] ?? null,
                'pickup_date'       => $data['pickup_date'] ?? null,
                'customer_notes'    => $data['customer_notes'] ?? null,
            ]);
        } else {
            $customer->userable->update([
                'name'              => $data['name'] ?? null,
                'state_id'          => $data['state_id'] ?? null,
                'address'           => $data['address'] ?? null,
                'housing_type'      => $data['housing_type'] ?? null,
                'house_number'      => $data['house_number'] ?? null,
                'building_number'   => $data['building_number'] ?? null,
                'apartment_number'  => $data['apartment_number'] ?? null,
            ]);
            $donation = Donation::create([
                'name'              => $data['name'] ?? null,
                'state_id'          => $data['state_id'] ?? null,
                'address'           => $data['address'] ?? null,
                'lat'               => $data['lat'] ?? null,
                'long'              => $data['long'] ?? null,
                'housing_type'      => $data['housing_type'] ?? null,
                'house_number'      => $data['house_number'] ?? null,
                'building_number'   => $data['building_number'] ?? null,
                'apartment_number'  => $data['apartment_number'] ?? null,
                'customer_id'       => $data['customer_id'] ?? null,
                'pickup_date'       => $data['pickup_date'] ?? null,
                'customer_notes'    => $data['customer_notes'] ?? null,
            ]);
        }
        if (request('photos')) {
            foreach ($data['photos'] as $photo) {
                DonationPhoto::create([
                    'donation_id'   => $donation->id,
                    'photo'         => $photo,
                ]);
            }
        }
        if (request('donation_types')) {
            foreach ($data['donation_types'] as $donation_type) {
                TypeOfDonation::create([
                    'donation_id'           => $donation->id,
                    'donation_type_id'      => $donation_type,
                ]);
            }
        }

        $customer->load('userable.donations.photos', 'userable.state', 'userable.donations.types.donationType');

        return response()->json($customer);
    }

    public function donations()
    {
        $data['donations'] = auth('api')->user()->userable->donations;
        return $data['donations']->load('photos', 'types.donationType');
    }

    public function donationFeedback($donation)
    {

        $validated = request()->validate([
            'feedback'       => 'nullable|numeric',
            'feedback_notes' => 'nullable|string'
        ]);
        $donation_data = Donation::find($donation);

        $donation_data->update($validated);
        $donation_data->load('photos', 'types.donationType');

        return response()->json(compact('donation_data'));
    }

    //--------------------- End Donation -----------------------//



    ##################################################################
    # Notifications
    ##################################################################

    public function notifications()
    {
        $notifications = Notification::where('user_id', auth('api')->id())->latest()->paginate(12);

        return response()->json($notifications);
    }

    public function notification(Notification $notification)
    {
        return response()->json($notification, 200);
    }

    //--------------------- End Notifications -----------------------//


    ##################################################################
    # Rates
    ##################################################################

    public function addOrUpdateRate()
    {
        $validated = request()->validate([
            'product_id'        => 'required',
            'rate'              => 'required',
        ]);
        $validated['user_id'] =  auth('api')->id();

        $product = Product::findOrFail(request('product_id'));
        if ($product) {
            $data['rate'] = ProductRate::updateOrCreate([
                'user_id'       => auth('api')->id(),
                'product_id'     => request('product_id')
            ], $validated);
        }
        $data['rate']->load('product');
        return response()->json($data);
    }

    //--------------------- End Rates -----------------------//






}
