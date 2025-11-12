<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail_icon',
        'description',

        // SEO & Display
        'meta_title',
        'meta_description',

        // Tags
        'tags',

        // Statistics
        'question_papers_count',
        'subjects_count',

        // Status & Display
        'position',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
