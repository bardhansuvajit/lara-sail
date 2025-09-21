<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInterestEmail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_variation_id',
        'email',
        'ip_address',
        'user_agent',
        'unsubscribe_token',
        'source',
        'meta',
        'unsubscribed_at',
        'subscription_count',
        'subscribed_at'
    ];

    protected $casts = [
        'meta' => 'array',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];
}
