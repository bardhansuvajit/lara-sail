<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class ProductCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'level',
        'image_s',
        'image_m',
        'image_l',
        'short_description',
        'long_description',
        'tags',
        'meta_title',
        'meta_desc',
        'position',
        'status',
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
            return self::active()->orderBy('position')->get();
        });
    }

    public function parentDetails()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id', 'id');
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
