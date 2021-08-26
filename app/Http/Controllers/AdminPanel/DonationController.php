<?php

namespace App\Http\Controllers\AdminPanel;

use App\Exports\DonationsExport;
use OneSignal;
use Carbon\Carbon;
use App\Models\Driver;
use App\Models\Donation;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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


    public function dateFilter()
    {

        $fromDate = (new Carbon(request('donation_from')))->format('y-m-d G:i:s');
        $toDate = (new Carbon(request('donation_to')))->format('y-m-d G:i:s');

        $donationsQuery = Donation::query();
        if (request()->filled('donation_from')) {
            $donationsQuery->whereBetween('pickup_date', [$fromDate, $toDate]);
        }
        $donations = $donationsQuery->get();

        return view('adminPanel.donations.index', compact('donations'));
    }

    public function export()
    {
        return Excel::download(new DonationsExport, 'donations.xlsx');
    }
}
