<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id', 'variation_identifier', 'sku', 'barcode', 'stock_quantity', 'track_quantity',
        'allow_backorders', 'sold_count', 'in_cart_count', 'primary_image_id',
        'price_adjustment', 'adjustment_type', 'weight_adjustment',
        'height_adjustment', 'width_adjustment', 'length_adjustment',
        'weight_unit', 'dimension_unit', 'is_default', 'status'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    protected static function booted()
    {
        static::created(function ($variation) {
            $variation->product->update(['has_variations' => 1]);
        });

        static::deleted(function ($variation) {
            $hasOtherVariations = $variation->product->variations()->exists();

            $variation->product->update([
                'has_variations' => $hasOtherVariations ? 1 : 0
            ]);
        });
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function combinations()
    {
        return $this->hasMany('App\Models\ProductVariationCombination', 'variation_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_variation_id', 'id')->orderBy('position', 'asc');
    }

    public function activeImages()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_variation_id', 'id')->where('status', 1)->orderBy('position', 'asc');
    }

    public function getFinalPriceAttribute()
    {
        $basePrice = $this->getBasePrice();

        return match($this->adjustment_type) {
            'fixed' => $basePrice + $this->price_adjustment,
            'percentage' => $basePrice * (1 + ($this->price_adjustment / 100)),
            default => $basePrice
        };
    }

    protected function getBasePrice()
    {
        return $this->product->pricings()
            ->where('country_id', request()->input('country_id', session('country_id')))
            ->orWhereNull('country_id')
            ->first()
            ?->selling_price ?? 0;
    }
}
