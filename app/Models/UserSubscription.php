<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    protected $table="subscriptions";
    protected $fillable = [
        'user_id',
        'product_id',
        'type',
        'invoice_number',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'product_price',
        'quantity',
        'plan_name',
        'starts_at',
        'ends_at',
        'pm_type',
        'pm_last_four',
        'card_exp_month',
        'card_exp_year',
        'card_name'
    ];
}
