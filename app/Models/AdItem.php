<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ad_section_id',
        'country_code',
        'title',
        'subtitle',
        'image_s',
        'image_m',
        'image_l',
        'cta_primary_text',
        'cta_primary_url',
        'cta_secondary_text',
        'cta_secondary_url',
        'meta',
        'start_at',
        'end_at',
        'show_offer_ends_timing',
        'status',
    ];

    protected $casts = [
        'meta' => 'array',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function section()
    {
        return $this->belongsTo(AdSection::class, 'ad_section_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }
}
