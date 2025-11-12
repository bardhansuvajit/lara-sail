<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolBoard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'thumbnail_icon',
        'description',
        'region',
        'type',

        // SEO & Display
        'meta_title',
        'meta_description',

        // Tags
        'tags',

        // Statistics
        'schools_count',
        'question_papers_count',

        // Status & Display
        'position',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
