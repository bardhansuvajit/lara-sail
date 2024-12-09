<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function imageDetails()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id')->orderBy('position')->orderBy('created_at');
    }

    public function activeImageDetails()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id')->where('status', 1)->orderBy('position');
    }
}
