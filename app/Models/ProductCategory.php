<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class ProductCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title','slug','parent_id','level',
        'image_s','image_m','image_l',
        'short_description','long_description',
        'tags','meta_title','meta_desc','position','status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('position', 'asc');
    }

    protected static function booted()
    {
        static::saved(function () {
            self::clearActiveCategoriesCache();
        });

        static::updated(function () {
            self::clearActiveCategoriesCache();
        });

        static::deleted(function () {
            self::clearActiveCategoriesCache();
        });
    }

    public static function clearActiveCategoriesCache()
    {
        Cache::forget('active_categories');

        // Optionally re-cache immediately if needed:
        Cache::rememberForever('active_categories', function () {
            return self::active()->with('activeChildrenByPosition')
                    ->whereNull('parent_id') // Level 1
                    ->orderBy('position')
                    ->get()
                    ->toArray();
        });
    }

    public function parentDetails()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id', 'id');
    }

    public function ancestors()
    {
        return $this->parentDetails()->with('ancestors');
    }

    public function childDetails()
    {
        return $this->hasMany('App\Models\ProductCategory', 'parent_id', 'id');
    }

    public function activeChildrenByPosition()
    {
        return $this->hasMany('App\Models\ProductCategory', 'parent_id')
            ->where('status', 1)
            ->with('activeChildrenByPosition') // recursive load
            ->orderBy('position');
    }

    public function variationAttributeValues()
    {
        return $this->hasMany('App\Models\ProductCategoryVariationAttribute', 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }

    public function activeProducts()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id')
            ->whereHas('statusDetail', function ($q) {
                $q->where('allow_order', 1);
            });
    }

    public function activeProductsInChildren()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')
            ->where('status', 1)
            ->with([
                'activeChildrenByPosition',  // recursive children
                'activeProducts'             // eager load active products
            ])
            ->orderBy('position');
    }

    public function getAllActiveProductsAttribute()
    {
        // Start with this category’s own active products
        $products = $this->activeProducts;

        // Recursively merge children’s products
        foreach ($this->activeChildrenByPosition as $child) {
            $products = $products->merge($child->all_active_products);
        }

        return $products;
    }

    public function variationValues()
    {
        return $this->belongsToMany(
            ProductVariationAttributeValue::class,
            'product_category_variation_attributes',
            'category_id',
            'attribute_value_id'
        );
    }
}
