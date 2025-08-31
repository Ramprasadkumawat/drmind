<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;
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
