<?php

namespace App\Http\Controllers\AdminPanel;

use App\Exports\DriverWeightExport;
use OneSignal;
use App\Models\Driver;
use App\Models\Donation;
use Laracasts\Flash\Flash;
use App\Models\DriverWeight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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


    public function export()
    {
        return Excel::download(new DriverWeightExport, 'driver-weights.xlsx');
    }
}
