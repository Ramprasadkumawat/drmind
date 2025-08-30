<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'image',
        'title',
        'slug',
        'user_id',
        'extension'
    ];
    protected $table = 'broadcast';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($broadcast) {
            if (empty($broadcast->slug)) {
                $slug = \Str::slug($broadcast->title);
                $count = static::where('slug', 'LIKE', "{$slug}%")->count();
                $broadcast->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }
}
