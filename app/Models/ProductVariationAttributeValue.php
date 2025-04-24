<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariationAttributeValue extends Model
{
    use SoftDeletes;

    protected $fillable = ['attribute_id', 'title', 'slug', 'meta', 'status'];

    public function attribute()
    {
        return $this->belongsTo('App\Models\ProductVariationAttribute', 'attribute_id', 'id');
    }

    public function categoryAttributes()
    {
        return $this->hasMany('App\Models\ProductCategoryVariationAttribute', 'attribute_value_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\ProductCategory', 'product_category_variation_attributes', 'attribute_value_id', 'category_id')
            ->whereNull('product_category_variation_attributes.deleted_at')
            ->whereNull('product_categories.deleted_at');
    }
}
