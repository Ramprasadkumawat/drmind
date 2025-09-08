<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_ids',
        'name',
        'slug',
        'content',
        'image_paths',
        'is_published',
        'is_homepage',
        'sliders',
        'main_paragraph_content',
        'extr-image_paths',
        'settings_order',
    ];

    protected $casts = [
        'category_ids' => 'array',
        'sliders' => 'array',
        'image_paths' => 'array',
        'extr-image_paths' => 'array',
    ];

    /**
     * Get the categories that belong to the page.
     */
    public function categories()
    {
        return Category::whereIn('id', $this->category_ids ?? [])->get();
    }

    public function getSlidersAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function getImagePathsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function getExtrImagePathsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
}
