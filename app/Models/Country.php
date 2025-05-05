<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Cache;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'short_name',
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
        return $this->hasMany('App\Models\State', 'country_id', 'id');
    }

    // Cache countries for 24 hours
    // public static function cachedCountries()
    // {
    //     return Cache::remember('active_countries', 86400, function () {
    //         return self::active()->get();
    //     });
    // }
}
