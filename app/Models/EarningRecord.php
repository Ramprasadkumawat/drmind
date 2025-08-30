<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarningRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'from_user',
        'meta_tag',
        'earning_point',
        'order_id'
    ];
}
