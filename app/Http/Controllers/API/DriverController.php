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

    public function my_orders()
    {
        $data['orders'] = Donation::where('driver_id', auth('api')->user()->userable_id)->with('photos')->get();
        return response()->json($data);
    }

    public function picked_up($donation)
    {
        $donation_data = Donation::find($donation);

        $donation_data->update(['status' => 1]);

        return response()->json(['msg' => 'status updated successfuly', $donation_data]);
    }

    public function delevered($donation)
    {
        $donation_data = Donation::find($donation);

        $donation_data->update(['status' => 2]);

        return response()->json(['msg' => 'status updated successfuly', $donation_data]);
    }

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
