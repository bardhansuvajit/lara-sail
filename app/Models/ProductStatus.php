<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStatus extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'allow_preorder',
        'allow_order',
        'description',
        'title_frontend',
        'description_frontend',
        'position',
        'status',
    ];

    protected $casts = [
        'allow_preorder' => 'boolean',
        'allow_order' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'status', 'id');
    }
}
