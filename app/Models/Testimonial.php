<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'status',
        'description',
        'image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($testimonial) {
            $testimonial->slug = Str::slug($testimonial->title);
        });

        static::updating(function ($testimonial) {
            $testimonial->slug = Str::slug($testimonial->title);
        });
    }
}
