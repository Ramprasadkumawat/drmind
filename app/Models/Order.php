<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_method',
        'payment_mode',
        'strip_id',
        'payment_intent_id',
        'payment_status',
        'status',
        'currency',
        'amount',
        'shipping_amount',
        'tax_amount',
        'email',
        'customer_name',
        'address',
        'products',
        'logistics_partner',
        'tracking_number'
    ];

    protected $casts = [
        'address' => 'array'
    ];
}
