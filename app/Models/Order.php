<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        // Order identification
        'order_number',

        // Customer information
        'user_id', 'device_id', 'email', 'phone_no',

        // Currency information
        'country', 'currency_code',

        // Order totals
        'total_items', 'mrp', 'sub_total', 'total',

        // Discount information
        'coupon_code_id', 'coupon_code', 'discount_amount', 'discount_type',

        // Shipping information
        'shipping_method_id', 'shipping_method_name', 'shipping_cost', 'shipping_address',

        // Billing information
        'billing_address', 'same_as_shipping',

        // Tax information
        'tax_amount', 'tax_type', 'tax_details',

        // Payment information
        'payment_method_id', 'payment_method_title', 'payment_method_charge', 'payment_method_discount',
        'payment_status', 'transaction_id', 'payment_details',

        // Order status
        'status', 'status_notes',

        // Tracking
        'paid_at', 'processed_at', 'shipped_at', 'delivered_at', 'cancelled_at', 'cancellation_reason',

        // Metadata
        'notes', 'custom_fields',
    ];

    protected $casts = [
        'total_items' => 'integer',
        'mrp' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'total' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'same_as_shipping' => 'boolean',
        'tax_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'processed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'custom_fields' => 'array',
        'tax_details' => 'array',
        'payment_details' => 'array',
        'notes' => 'string',
        'status_notes' => 'string',
    ];

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id')->orderBy('id', 'desc');
    }
}
