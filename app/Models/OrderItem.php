<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_title',
        'product_sku',
        'product_description',
        'product_image',

        'mrp',
        'price',
        'discount_amount',
        'discount_type',

        'quantity',
        'total',

        'tax_amount',
        'tax_type',
        'tax_details',

        'status',
        'status_notes',

        'custom_fields',
    ];

    protected $casts = [
        'mrp' => 'decimal:2',
        'price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'quantity' => 'integer',
        'total' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'tax_details' => 'array',
        'custom_fields' => 'array',
        'status_notes' => 'string',
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
