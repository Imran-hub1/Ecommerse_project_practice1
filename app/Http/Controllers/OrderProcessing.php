<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderProcessing extends Controller
{
    public function order()
    {

        return view('admin.processing.order');
    }
}
