<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductFile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',

        // file data
        'file_path',
        'file_size',
        'file_name',
        'file_type',

        // additions
        'original_name',
        'mime_type',
        'disk',
        'extension',

        // extra fields
        'sort_order',
        'is_active',
        'description',
        'download_count',
    ];
}
