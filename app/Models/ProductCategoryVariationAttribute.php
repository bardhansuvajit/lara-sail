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

    public function attribute()
    {
        return $this->belongsTo('App\Models\ProductVariationAttribute', 'attribute_id', 'id');
    }

}
