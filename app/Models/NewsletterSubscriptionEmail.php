<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterSubscriptionEmail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'email',
        'ip_address',
        'user_agent',
        'source',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];
}
