<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'country_code',
        'logo_path',
        'description',
        'district',
        'address',
        'city',
        'state',
        'pincode',

        // School Type & Level
        'type',
        'level',
        'board_affiliation',

        // Contact Information
        'official_email',
        'phone_number',
        'alternate_phone',
        'website',
        'fax',

        // Contact Person Details
        'contact_person_name',
        'contact_person_designation',
        'contact_person_mobile',
        'contact_person_email',

        // Academic Information
        'established_year',
        'principal_name',

        // SEO & Display
        'meta_title',
        'meta_description',

        // Tags
        'tags',

        // Statistics
        'question_papers_count',
        'student_count',
        'teacher_count',

        // Status & Display
        'position',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
    ];
}
