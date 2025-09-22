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
        'search_tags',
        'meta_title',
        'meta_desc',
        'type',
        'status',
    ];

    public function statusDetail()
    {
        return $this->belongsTo('App\Models\ProductStatus', 'status', 'id');
    }

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
        return $this->hasMany('App\Models\ProductPricing', 'product_id', 'id')
            ->where('product_variation_id', null)
            ->orderBy('id', 'asc');
    }

    // get only pricing matching with cookie
    public function FDPricing()
    {
        return $this->hasOne('App\Models\ProductPricing', 'product_id', 'id')
            ->where('product_variation_id', null)
            ->where('country_code', COUNTRY['country'])
            ->where('status', 1);
    }

    public function featured()
    {
        return $this->hasOne('App\Models\ProductFeature', 'product_id', 'id');
    }

    public function variations()
    {
        return $this->hasMany('App\Models\ProductVariation', 'product_id', 'id')->orderBy('id', 'desc');
    }

    public function activeVariations()
    {
        return $this->hasMany('App\Models\ProductVariation', 'product_id', 'id')->where('status', 1)->orderBy('position', 'asc');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id');
    }

    public function activeReviews()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id')
            ->where('status', 1);
    }

    public function badges()
    {
        return $this->hasMany('App\Models\ProductBadgeCombination', 'product_id', 'id');
    }

    public function highlights()
    {
        return $this->hasMany('App\Models\ProductHighlightList', 'product_id', 'id')->orderBy('position', 'asc');
    }

    public function activeHighlights()
    {
        return $this->hasMany('App\Models\ProductHighlightList', 'product_id', 'id')
            ->where('status', 1)
            ->orderBy('position', 'asc');
    }

    public function Faqs()
    {
        return $this->hasMany('App\Models\ProductFaq', 'product_id', 'id')->orderBy('position', 'asc');
    }

    public function activeFaqs()
    {
        return $this->hasMany('App\Models\ProductFaq', 'product_id', 'id')
            ->where('status', 1)
            ->orderBy('position', 'asc');
    }

    /*
    public function getFinalPriceAttribute()
    {
        return $this->pricings()
            ->where('country_id', request()->input('country_id', session('country_id')))
            ->orWhereNull('country_id')
            ->first()
            ?->selling_price ?? 0;
    }
    */

    public function updateRating()
    {
        $reviews = $this->reviews()->where('status', 1)->get();

        $this->review_count = $reviews->count();
        $this->average_rating = $this->review_count > 0 
            ? round($reviews->avg('rating'), 1)
            : 0;

        $this->save();
    }
}
