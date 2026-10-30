<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table = 'customer';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'delivery_address',
        'payment_method',
    ];
}
