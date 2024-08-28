<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller {
    public function dashboard() {
        $data                        = [];
        $data['todays_order']        = Order::where('created_at', today())->count();
        $data['todays_cancel_order'] = Order::where('created_at', today())->where('status', 0)->count();
        $data['cancel_order']        = Order::where('status', 0)->count();
        $data['pending_order']       = Order::where('status', 1)->count();
        $data['confirm_order']       = Order::where('status', 2)->count();
        $data['shipped_order']       = Order::where('status', 3)->count();

        $data['active_product']   = Product::where('status', 1)->count();
        $data['inactive_product'] = Product::where('status', 0)->count();

        $data['customer'] = User::count();
        $data['admin']    = Admin::count();

        return view('backend.dashboard', $data);
    }
}
