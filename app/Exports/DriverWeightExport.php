<?php

namespace App\Exports;

use App\Models\DriverWeight;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DriverWeightExport implements FromView
{

    public function view(): View
    {

        return view('adminPanel.driver_weights.table', [
            'driver_weights' => DriverWeight::get()
        ]);
    }
}
