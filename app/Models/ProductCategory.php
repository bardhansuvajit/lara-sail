<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function parentDetails()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id', 'id');
    }

    public function childDetails()
    {
        return $this->hasMany('App\Models\ProductCategory', 'parent_id', 'id');
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
