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
}
