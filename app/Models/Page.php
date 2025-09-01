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
        'slider_content',
        'paragraph_content',
        'image_paths',
        'is_published',
        'is_homepage',
        'slider_text',
        'slider_image_path',
        'main_paragraph_content',
        'extr-image_paths',
    ];

    /**
     * Get the category that owns the page.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
