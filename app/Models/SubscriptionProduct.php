<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubscriptionProduct extends Model
{
    use HasFactory;
     protected $fillable = [
        'product_name',
        'slug',
        'manufacturar_name',
        'product_identification_no',
        'product_sku',
        'description',
        'short_description',
        'product_status',
        'publish_date',
        'level_one',
        'level_two',
        'level_three',
        'earning_point',
        'product_category',
        'product_subcategory',
        'tags',
        'specification_terms',
        'monthly_price',
        'half_yearly_price',
        'yearly_price',
        'price_currency',
        'discount_value',
        'search_vector',
        'e_pdf_url',
        'stripe_product_id',
        'stripe_price_id',
    ];

    protected $casts = [
        'publish_date' => 'datetime',
        'base_price' => 'float',
        'discount_value' => 'float',
        'product_price' => 'float',
    ];

    // === RELATIONS ===

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'product_subcategory');
    }
    public function productImages()
    {
        return $this->hasMany(SubscriptionProductImage::class, 'product_id');
    }

    // === SLUG AUTO GENERATOR ===

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug) && !empty($product->product_name)) {
                $slug = Str::slug($product->product_name);

                // Ensure unique slug
                $originalSlug = $slug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }

                $product->slug = $slug;
            }
        });
    }

    // === SCOPES ===

    public function scopeFullTextSearch($query, $term)
    {
        return $query->whereRaw(
            "search_vector @@ plainto_tsquery('english', ?)", 
            [$term]
        );
    }
}
