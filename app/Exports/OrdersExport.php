<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class OrdersExport implements FromView
{

    public function view(): View
    {

        return view('adminPanel.orders.table', [
            'orders' => Order::get()
        ]);
    }
}
