<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;

class CustomerAddressController extends Controller
{
    public function customerProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'delivery_address' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        CustomerAddress::updateOrCreate(

            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'delivery_address' => $request->delivery_address,
                'payment_method' => $request->payment_method,
            ],
        );

        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return response()->json([
                'status' => false,
                'message' => 'Your cart is empty!'
            ]);
        }
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = 60;
        $grandTotal = $subtotal + $shipping;
        $order = Order::create([

            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'grand_total' => $grandTotal,
            'discount' => 0,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'delivery_address' => $request->delivery_address,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        // ৭. সফলভাবে অর্ডার শেষে কার্ট খালি করে দেওয়া
        session()->forget('cart');

        // ৮. ফাইনাল সাকসেস রেসপন্স রিটার্ন করা
        return response()->json([
            'status' => true,
            'message' => 'Order Placed Successfully!',
            'order_id' => $order->id,
            'redirect_url' => url('/order-success/' . $order->id)
        ]);
    }
    public function orderSuccess($id)
    {
        $order = Order::find($id);

        return view('admin.order.success', compact('order'));
    }
}
