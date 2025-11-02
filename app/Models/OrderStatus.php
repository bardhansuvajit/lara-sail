<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = [
        'type',
        'slug',
        'title',
        'description',
        'class',
        'position',
        'status',
        'is_default',
        'is_final',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_default' => 'boolean',
        'is_final' => 'boolean',
        'position' => 'integer',
    ];
}
