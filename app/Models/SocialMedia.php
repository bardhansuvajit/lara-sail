<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class SocialMedia extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'icon_colored',
        'icon_base',
        'url',
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
            self::clearActiveSocialMediaCache();
        });

        static::deleted(function () {
            self::clearActiveSocialMediaCache();
        });
    }

    public static function clearActiveSocialMediaCache()
    {
        Cache::forget('active_social_media');

        // Optionally re-cache immediately if needed:
        Cache::rememberForever('active_social_media', function () {
            return self::active()->get();
        });
    }
}
