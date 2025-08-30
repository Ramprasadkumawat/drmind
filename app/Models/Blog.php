<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'status',
        'image',
        'message',
        'slug',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($Blog) {
            $Blog->slug = Str::slug($Blog->title);
        });

        static::updating(function ($Blog) {
            $Blog->slug = Str::slug($Blog->title);
        });
    }
}
