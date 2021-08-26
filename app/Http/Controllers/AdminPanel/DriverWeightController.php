<?php

namespace App\Http\Controllers\AdminPanel;

use OneSignal;
use Carbon\Carbon;
use App\Models\Driver;
use App\Models\Donation;
use Laracasts\Flash\Flash;
use App\Models\DriverWeight;
use Illuminate\Http\Request;
use App\Exports\DriverWeightExport;
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

    public function dateFilter()
    {

        $fromDate = (new Carbon(request('weight_from')))->format('y-m-d G:i:s');
        $toDate = (new Carbon(request('weight_to')))->format('y-m-d G:i:s');

        $weightsQuery = DriverWeight::query();
        if (request()->filled('weight_from')) {
            $weightsQuery->whereBetween('date', [$fromDate, $toDate]);
        }
        $driver_weights = $weightsQuery->get();

        return view('adminPanel.driver_weights.index', compact('driver_weights'));
    }

    public function export()
    {
        return Excel::download(new DriverWeightExport, 'driver-weights.xlsx');
    }
}
