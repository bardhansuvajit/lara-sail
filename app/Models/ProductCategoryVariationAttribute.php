<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategoryVariationAttribute extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id', 'id');
    }

    public function attributeValue()
    {
        return $this->belongsTo('App\Models\ProductVariationAttributeValue', 'attribute_value_id', 'id');
    }

}
