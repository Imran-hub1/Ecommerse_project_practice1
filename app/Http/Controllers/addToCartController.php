<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class addToCartController extends Controller
{
    public function cart()
    {
        $cartProducts = session()->get('cart', []);



        return view('admin.cart.index', compact('cartProducts'));
    }

    public function addToCart(Request $request)
    {
        // ১. AJAX থেকে পাঠানো ডাটাগুলো রিসিভ করা
        $id    = $request->id;
        $name  = $request->name;
        $price = $request->price;
        $image = $request->image;
        $qty  = $request->qty ?? 1; // যদি পাঠানো না হয়, তবে ডিফল্ট ১ ধরবে

        // ২. সেশন থেকে কার্ট ডাটা আনা (আগে না থাকলে খালি অ্যারে [])
        $cart = session()->get('cart', []);



        // ৩. প্রডাক্টটি ইতিমধ্যে কার্টে আছে কি না চেক করা
        if (isset($cart[$id])) {
            // যদি থাকে, তবে আগের কোয়ান্টিটির সাথে নতুন কোয়ান্টিটি যোগ করে দেবো
            $cart[$id]['quantity'] += $qty;
        } else {
            // যদি না থাকে, তবে নতুন প্রডাক্ট হিসেবে কার্টে যুক্ত করবো
            $cart[$id] = [
                'id' => $id,
                "name"     => $name,
                "price"    => $price,
                "quantity" => $qty,
                "image"    => $image
            ];
        }

        // ৪. আপডেট হওয়া কার্টটি আবার সেশনে সেভ করা
        session()->put('cart', $cart);

        // ৫. কার্টে মোট কতগুলো প্রডাক্ট আছে তার সংখ্যা বের করা
        $cartCount = array_sum(array_column($cart, 'quantity'));

        // ৬. ফ্রন্টএন্ডে (jQuery AJAX) JSON রেসপন্স পাঠানো
        return response()->json([
            'status'    => 'success',
            'success'   => 'প্রডাক্ট সফলভাবে কার্টে যোগ হয়েছে!',
            'cartCount' => $cartCount
        ]);
    }
    public function updateCart(Request $request)
    {
        $id = $request->id;
        $change = $request->change;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // কোয়ান্টিটি আপডেট করা
            $cart[$id]['quantity'] += $change;

            // যদি কোয়ান্টিটি ১ এর নিচে নেমে যায়, তবে প্রডাক্টটি কার্ট থেকে রিমুভ করে দিতে পারেন
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'status' => 'success',
            'message' => 'কার্ট আপডেট সফল হয়েছে!',
            'cartCount' => $cartCount
        ]);
    }
    public function removeCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->save();
        }
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'status' => 'success',
            'message' => 'প্রডাক্ট সফলভাবে রিমুভ করা হয়েছে!',
            'cartCount' => $cartCount
        ]);
    }


    public function checkout()
    {
        return view('admin.checkout.index');
    }
}
