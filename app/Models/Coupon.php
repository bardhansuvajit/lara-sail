<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_code', 'code', 'name', 'description',
        'discount_type', 'value', 'max_discount_amount',
        'min_cart_value','usage_limit','usage_per_user','used_count',
        'starts_at','expires_at',
        'show_in_frontend',
        'position','status',
    ];
}
