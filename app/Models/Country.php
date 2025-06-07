<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'phone_code',
        'phone_no_digits',
        'zip_code_format',
        'currency_code',
        'currency_symbol',
        'continent',
        'flag',
        'language',
        'time_zone',
        'shipping_availability',
        'cash_on_delivery_availability',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function states()
    {
        return $this->hasMany('App\Models\State', 'country_code', 'code');
    }

    protected static function booted()
    {
        static::saved(function () {
            self::clearActiveCountriesCache();
        });

        static::deleted(function () {
            self::clearActiveCountriesCache();
        });
    }

    public static function clearActiveCountriesCache()
    {
        Cache::forget('active_countries');

        // Optionally re-cache immediately if needed:
        Cache::rememberForever('active_countries', function () {
            return self::active()->get();
        });
    }

    // public function scopeActive($query)
    // {
    //     return $query->where('status', 1);
    // }

}
