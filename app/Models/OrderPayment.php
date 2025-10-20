<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $fillable = [
        'order_id',
        'gateway',
        'gateway_payment_id',
        'gateway_order_id',
        'amount',
        'currency',
        'status',
        'meta'
    ];

    protected $casts = [
        'meta' => 'array',
        'amount' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
