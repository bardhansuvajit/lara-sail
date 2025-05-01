<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariationCombination extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'variation_id', 'attribute_id', 'attribute_value_id', 'status'
    ];

    public function variation()
    {
        return $this->belongsTo('App\Models\ProductVariation', 'variation_id', 'id');
    }

    public function attribute()
    {
        return $this->belongsTo('App\Models\ProductVariationAttribute', 'attribute_id', 'id');
    }

    public function attributeValue()
    {
        return $this->belongsTo('App\Models\ProductVariationAttributeValue', 'attribute_value_id', 'id');
    }
}
