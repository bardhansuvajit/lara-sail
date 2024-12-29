<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'level',
        'img_small',
        'img_medium',
        'img_large',
        'short_description',
        'long_description',
        'tags',
        'meta_title',
        'meta_desc',
        'meta_keyword',
        'type',
        'status',
    ];
}
