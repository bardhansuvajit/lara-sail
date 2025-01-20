<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
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
}
