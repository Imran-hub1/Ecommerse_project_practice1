<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ProductOrderController extends Controller
{
    public function orderProcess()
    {
        $orders = Order::get();
        return view('admin.orders.order', compact('orders'));
    }
}
