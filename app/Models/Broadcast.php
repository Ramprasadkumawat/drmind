<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Broadcast extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'broadcast';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
