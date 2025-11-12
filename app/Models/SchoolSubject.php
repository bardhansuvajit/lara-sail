<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolSubject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'thumbnail_icon',
        'logo_path',
        'description',
        'category',
        'is_core',

        // SEO & Display
        'meta_title',
        'meta_description',

        // Tags
        'tags',

        // Statistics
        'question_papers_count',

        // Status & Display
        'position',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_core' => 'boolean',
    ];
}
