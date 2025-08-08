<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentPage extends Model
{
    protected $fillable = [
        'slug', 'title', 'content', 'meta_title', 
        'meta_description', 'sections', 'is_active'
    ];

    protected $casts = [
        'sections' => 'array',
        'is_active' => 'boolean'
    ];
}
