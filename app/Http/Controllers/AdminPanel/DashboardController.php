<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Distributor;
use App\Models\Donation;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['new_donations_count'] = Donation::where('status', 0)->count();
        $data['pichedup_donations_count'] = Donation::where('status', 1)->count();
        $data['delivered_donations_count'] = Donation::where('status', 2)->count();
        $data['not_ickedup_donations_count'] = Donation::where('status', 3)->count();


        $data['new_orders_count'] = Order::where('status', 0)->count();
        $data['delivered_orders_count'] = Order::where('status', 1)->count();
        $data['not_delivered_orders_count'] = Order::where('status', 2)->count();

        $data['orders'] = Order::latest()->limit(5)->get();
        $data['donations'] = Donation::latest()->limit(5)->get();
        $data['customers'] = Customer::latest()->limit(5)->get();

        $data['customers_count'] = Customer::count();
        $data['drivers_count'] = Driver::count();
        $data['orders_count'] = Order::count();
        $data['donations_count'] = Donation::count();
        $data['products_count'] = Product::count();

        return view('adminPanel.home', compact('data'));
    }
}
