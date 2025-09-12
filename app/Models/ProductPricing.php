<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPricing extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_variation_id',
        'country_code',
        'min_quantity',
        'price_type',
        'selling_price',
        'mrp',
        'discount',
        'cost',
        'profit',
        'margin',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }
}
