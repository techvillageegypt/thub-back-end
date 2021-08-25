<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Driver;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use OneSignal;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::get();

        return view('adminPanel.donations.index', compact('donations'));
    }

    public function show(Donation $donation)
    {
        $drivers = Driver::where('state_id', $donation->state_id)->get()->pluck('name', 'id');

        return view('adminPanel.donations.show', compact('donation', 'drivers'));
    }

    public function assign_driver(Donation $donation)
    {
        $donation->update(['driver_id' => request('driver_id'), 'status' => 5]);
        $driver = Driver::find(request('driver_id'));

        OneSignal::sendNotificationToUser(
            "You have  a new order",
            $driver->user->device_id,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );

        Flash::success('The Donation Order Assigned Successfuly');

        return back();
    }

    public function updatePickupDate(Donation $donation)
    {
        $donation->update(['pickup_date' => request('pickup_date'), 'status' => 0]);

        Flash::success('The Donation Order Rescheduled Successfuly');

        return back();
    }
}
