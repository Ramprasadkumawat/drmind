<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'content',
        'image_paths',
        'is_published',
        'is_homepage',
        'slider_text',
        'slider_image_path',
        'main_paragraph_content',
        'extr-image_paths',
        'settings_order',
    ];

    /**
     * Get the category that owns the page.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
