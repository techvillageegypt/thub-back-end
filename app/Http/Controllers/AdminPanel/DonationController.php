<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Driver;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

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
        // dd(request('driver_id'));
        // dd($donation);
        $donation->update(['driver_id' => request('driver_id')]);

        Flash::success('The Donation Order Assigned Successfuly');

        return back();
    }
}
