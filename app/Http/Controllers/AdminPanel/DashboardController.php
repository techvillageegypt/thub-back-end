<?php

namespace App\Http\Controllers\AdminPanel;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Donation;
use App\Models\Distributor;
use App\Models\DriverWeight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['new_donations_count'] = Donation::where('status', 0)->count();
        $data['pichedup_donations_count'] = Donation::where('status', 1)->count();
        $data['delivered_donations_count'] = Donation::where('status', 2)->count();
        $data['not_ickedup_donations_count'] = Donation::where('status', 3)->count();
        $data['reschedule_donations_count'] = Donation::where('status', 4)->count();
        $data['inProgress_donations_count'] = Donation::where('status', 5)->count();

        // dd($data['inProgress_donations_count']);

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
        $data['total_daily_weight'] = DriverWeight::whereDay('date', Carbon::now()->day)->sum('weight');
        return view('adminPanel.home', compact('data'));
    }
}
