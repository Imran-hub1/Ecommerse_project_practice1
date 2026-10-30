<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::where('status', 1)->take(3)->get();

        return view('admin.home.index', compact('products'));
    }
    public function detail($id)
    {
        $product = Product::findorFail($id);
        return view('admin.detail', compact('product'));
    }
}
