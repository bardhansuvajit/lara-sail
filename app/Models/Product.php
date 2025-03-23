<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

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
}
