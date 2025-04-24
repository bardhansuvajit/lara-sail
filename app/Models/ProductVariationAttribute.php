<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariationAttribute extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'is_global', 'status'];

    public function values()
    {
        return $this->hasMany('App\Models\ProductVariationAttributeValue', 'attribute_id', 'id')->orderBy('position', 'asc')->orderBy('id', 'desc');
    }

    // public function categoryAttributes()
    // {
    //     return $this->hasMany('App\Models\ProductCategoryVariationAttribute', 'attribute_id', 'id');
    // }
}
