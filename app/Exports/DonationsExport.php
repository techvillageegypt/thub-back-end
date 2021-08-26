<?php

namespace App\Exports;

use App\Models\Donation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DonationsExport implements FromView
{

    public function view(): View
    {

        return view('adminPanel.donations.table', [
            'donations' => Donation::get()
        ]);
    }
}
