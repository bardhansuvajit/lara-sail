<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCollection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'image_s',
        'image_m',
        'image_l',
        'short_description',
        'long_description',
        'tags',
        'meta_title',
        'meta_desc',
        'meta_keyword',
        'position',
        'status',
    ];
}
