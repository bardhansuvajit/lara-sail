<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'collection_ids',
        'short_description',
        'long_description',
        'average_rating',
        'review_count',
        'sku',
        'barcode',
        'has_variations',
        'stock_quantity',
        'track_quantity',
        'allow_backorders',
        'sold_count',
        'in_cart_count',
        'weight',
        'height',
        'width',
        'length',
        'weight_unit',
        'dimension_unit',
        'tags',
        'meta_title',
        'meta_desc',
        'type',
        'status',
    ];    

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id')->orderBy('position')->orderBy('id', 'desc');
    }

    public function activeImages()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id')->where('status', 1)->orderBy('position');
    }

    public function pricings()
    {
        return $this->hasMany('App\Models\ProductPricing', 'product_id', 'id')->orderBy('id', 'asc');
    }

    public function featured()
    {
        return $this->hasOne('App\Models\ProductFeature', 'product_id', 'id');
    }

    public function variations()
    {
        return $this->hasMany('App\Models\ProductVariation', 'product_id', 'id')->orderBy('position')->orderBy('id', 'desc');
    }
}
