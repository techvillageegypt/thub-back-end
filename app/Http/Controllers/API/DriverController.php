<?php

namespace App\Http\Controllers\API;


use App\Models\Seek;
use App\Models\Trip;
use App\Models\Reward;
use App\Models\Vehicle;
use App\Models\DriverRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\VehiclePhotos;
use App\Helpers\CapServiceTrait;
use App\Helpers\TowingTruckTrait;
use App\Models\DriverBankAccount;
use App\Http\Controllers\Controller;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Models\CustomerRate;
use App\Models\Donation;
use App\Models\Order;

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
            'floor_number'      => 'nullable',
            'apartment_number'  => 'nullable',
        ]);

        $user->userable()->update($data);
        $user->load('userable');

        return response()->json(compact('user'));
    }


    //////////////// Donations //////////////////
    public function picked_up($donation)
    {
        $donation_data = Donation::find($donation);

        $donation_data->update(['status' => 1, 'driver_notes' => request('driver_notes')]);
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
