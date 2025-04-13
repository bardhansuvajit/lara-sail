<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
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
