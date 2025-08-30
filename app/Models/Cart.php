<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        
    ];
    protected $casts = [
        'quantity' => 'integer',
     
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class)->select(['id', 'product_name', 'product_price','product_category','product_subcategory','product_stock','earning_point','level_one','level_two','level_three']);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category', 'id')
            ->select(['id', 'category_name']);
    }

   

    public function scopeWithProductDetails($query)
    {
        return $query->with([
            'product' => function ($q) {
                $q->select(['id', 'product_name', 'product_price', 'product_category', 'product_subcategory'])
                  ->with([
                      'category:id,category_name',
                       'subcategory:id,category_name',
                      'productImages'
                  ]);
            }
        ]);
    }

    public function scopeWithUserDetails($query)
    {
        return $query->with('user');
    }

    public function scopeWithSelectedProductFields($query)
    {
        return $query->with([
            'product:id,product_name,product_price,product_category,product_subcategory',
            'product.category:id,category_name',
            'product.subcategory:id,subcategory_name'
        ]);
    }

    public function scopeWithProductAndUserDetails($query)
    {
        return $query->with([
            'product' => function ($q) {
                $q->select(['id', 'product_name', 'product_price', 'product_category', 'product_subcategory','product_stock'])
                  ->with([
                      'category:id,name',
                      'subcategory:id,name',
                      'productImages'
                  ]);
            },
            'user'
        ]);
    }
}
