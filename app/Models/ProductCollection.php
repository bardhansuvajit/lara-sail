<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

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
        'position',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('position', 'asc');
    }

    protected static function booted()
    {
        static::saved(function () {
            self::clearActiveCollectionsCache();
        });

        static::updated(function () {
            self::clearActiveCollectionsCache();
        });

        static::deleted(function () {
            self::clearActiveCollectionsCache();
        });
    }

    public static function clearActiveCollectionsCache()
    {
        Cache::forget('active_collections');

        // Optionally re-cache immediately if needed:
        Cache::rememberForever('active_collections', function () {
            return self::active()->orderBy('position')->get();
        });
    }
}
