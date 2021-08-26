<?php

namespace App\Http\Controllers\API;


use App\Models\Seek;
use App\Models\Trip;
use App\Models\Order;
use App\Models\Reward;
use App\Models\Vehicle;
use App\Models\Donation;
use App\Models\DriverRate;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\VehiclePhotos;
use App\Helpers\CapServiceTrait;
use App\Helpers\TowingTruckTrait;
use App\Models\DriverBankAccount;
use App\Events\NotificationPusher;
use App\Http\Controllers\Controller;
use App\Models\DriverWeight;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\DB;
use OneSignal;

class DriverController extends Controller
{

    public function test()
    {
        return ('test home');
    }

    ##################################################################
    # Main
    ##################################################################

    public function update_information(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->validate([
            'name'              => 'required|string|max:191',
            'address'           => 'nullable|string|max:191',
            'housing_type'      => 'nullable|in:1,2',
            'state_id'          => 'nullable',
            'building_number'   => 'nullable',
            'apartment_number'  => 'nullable',
        ]);

        $user->userable()->update($data);
        $user->load('userable');

        return response()->json(compact('user'));
    }


    //////////////// Donations //////////////////
    public function picked_up($donation)
    {
        $validated = request()->validate([
            'driver_notes'      => 'nullable|string',
            'bags'              => 'nullable|numeric',
            'plastic_bags'      => 'nullable|numeric',
            'cartons'           => 'nullable|numeric',
            'cars'              => 'nullable|numeric',
        ]);
        $validated['status'] = 1;

        $donation_data = Donation::find($donation);

        $donation_data->update($validated);

        $donation_data->load('photos', 'types.donationType', 'customer.user', 'state');

        return response()->json(['msg' => 'status updated successfuly', $donation_data]);
    }

    public function not_picked_up($donation)
    {
        $donation_data = Donation::find($donation);

        $donation_data->update(['status' => 3, 'driver_notes' => request('driver_notes')]);
        $donation_data->load('photos', 'types.donationType', 'customer.user', 'state');

        return response()->json(['msg' => 'status updated successfuly', $donation_data]);
    }

    public function delevered($donation)
    {
        $donation_data = Donation::find($donation);

        $donation_data->update(['status' => 2, 'driver_notes' => request('driver_notes')]);
        $donation_data->load('photos', 'types.donationType', 'customer.user', 'state');

        // Fire & save Notification
        Notification::create([
            'user_id' => $donation_data->customer->user->id,
            'type' => 'donation_delivered',
            'en' => [
                'text' => 'Thanks, Your Donation Delivered To Thub Successfuly',
            ],
            'ar' => [
                'text' => 'شكراً لك , لقد تم تسليم تبرعك لثوب بنجاح',
            ]

        ]);

        event(new NotificationPusher([
            'type'      => 'donation_delivered',
            'send_to'   => $donation_data->customer->user->id,
            'data'      => $donation_data,
            'text'      => __('lang.donation_delivered'),
        ]));

        $notificationData = [
            'bags'              => $donation_data->bags,
            'plastic_bags'      => $donation_data->plastic_bags,
            'cartons'           => $donation_data->cartons,
            'cars'              => $donation_data->cars,
        ];

        OneSignal::sendNotificationToUser(
            __('lang.donation_delivered'),
            $donation_data->customer->user->device_id,
            $url = null,
            $data = $notificationData,
            $buttons = null,
            $schedule = null
        );

        return response()->json(['msg' => 'status updated successfuly', $donation_data]);
    }

    public function reschedule($donation)
    {
        $donation_data = Donation::find($donation);

        $donation_data->update(['status' => 4, 'driver_notes' => request('driver_notes')]);
        $donation_data->load('photos', 'types.donationType', 'customer.user', 'state');

        return response()->json(['msg' => 'status updated successfuly', $donation_data]);
    }

    public function my_orders()
    {
        if (auth('api')->user()->type !== 'driver') {
            return response()->json(['msg' => 'You are Not Driver'], 403);
        }

        $data['orders'] = Donation::where('driver_id', auth('api')->user()->userable_id)->with('photos', 'types.donationType', 'customer.user', 'state')->get();
        return response()->json($data);
    }

    public function dailyWeight()
    {
        $validated = request()->validate(['weight' => 'required|numeric']);
        $validated['driver_id'] = auth('api')->user()->userable->id;
        $validated['date'] = now();

        DriverWeight::create($validated);

        return response()->json($validated);
    }

    //////////////// End Donations //////////////////


    //////////////// Ecommerce //////////////////
    public function ecommerce_delevered($order)
    {
        $order_data = Order::find($order);

        $order_data->update(['status' => 1, 'driver_notes' => request('driver_notes')]);
        $order_data->load('items');

        return response()->json(['msg' => 'status updated successfuly', $order_data]);
    }

    public function ecommerce_not_delevered($order)
    {
        $order_data = Order::find($order);

        $order_data->update(['status' => 2, 'driver_notes' => request('driver_notes')]);
        $order_data->load('items');

        return response()->json(['msg' => 'status updated successfuly', $order_data]);
    }

    public function my_ecommerce_orders()
    {
        if (auth('api')->user()->type !== 'driver') {
            return response()->json(['msg' => 'You are Not Driver'], 403);
        }

        $data['orders'] = Order::where('driver_id', auth('api')->user()->userable_id)->with('items')->get();
        return response()->json($data);
    }
    //////////////// End Ecommerce //////////////////

    //------------------------- End Main ---------------------------//


    ##################################################################
    # Notifications
    ##################################################################

    public function notifications()
    {
        $notifications = Notification::driver()->get();

        return response()->json($notifications, 200);
    }

    public function notification(Notification $notification)
    {
        return response()->json($notification, 200);
    }

    //--------------------- End Notifications -----------------------//


}
