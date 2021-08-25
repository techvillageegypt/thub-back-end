<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Driver;
use App\Models\DriverWeight;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use OneSignal;

class DriverWeightController extends Controller
{
    public function index()
    {
        $driver_weights = DriverWeight::get();

        return view('adminPanel.driver_weights.index', compact('driver_weights'));
    }

    public function updateDriverWeight($id)
    {
        $driverWeight = DriverWeight::find($id);
        $driverWeight->update(['weight' => request('weight')]);

        Flash::success('The Driver Weight Updated Successfuly');

        return back();
    }
}
