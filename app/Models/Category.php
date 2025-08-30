<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory ,SoftDeletes ;
 
    protected $fillable = ['type', 'name', 'image_path', 'slug', 'parent_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
     public function products()
    {
        return $this->hasMany(Product::class, 'product_category'); // replace column name if needed
    }
}

