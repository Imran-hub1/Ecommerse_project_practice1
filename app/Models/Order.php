<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';


    protected $fillable = [
        'user_id',
        'subtotal',
        'shipping',
        'grand_total',
        'discount',
        'name',
        'email',
        'phone',
        'delivery_address',
        'payment_method',
        'payment_status',
        'order_status',
    ];
}
