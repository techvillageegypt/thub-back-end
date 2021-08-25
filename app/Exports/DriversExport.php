<?php

namespace App\Exports;

use App\Models\Driver;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DriversExport implements FromView
{
    public function view(): View
    {
        return view('adminPanel.drivers.table', [
            'drivers' => Driver::all()
        ]);
    }
}
