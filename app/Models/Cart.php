<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'device_id','user_id','country','currency_code','total_items','mrp','sub_total','total',
        'coupon_code_id','coupon_code','discount_amount','discount_type','shipping_method_id',
        'shipping_cost','tax_amount','tax_type','tax_details',
        'payment_method_id','payment_method_title','payment_method_charge','payment_method_discount','last_activity_at',
        'abandoned_at','is_abandoned','reminder_count',
        'status'
    ];

    public function countryDetail()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'code');
    }

    public function allItems()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id', 'id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id', 'id')->where('is_saved_for_later', 0)->orderBy('id', 'desc');
    }

    public function savedItems()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id', 'id')->where('is_saved_for_later', 1)->orderBy('id', 'desc');
    }

    public function shippingMethod()
    {
        return $this->belongsTo('App\Models\ShippingMethod', 'shipping_method_id', 'id');
    }

    // mark abandon
    public function shouldBeMarkedAbandoned()
    {
        return !$this->is_abandoned &&
            $this->last_activity_at < now()->subHours(24) && 
            $this->total_items > 0;
    }

    public function recalculateTotals()
    {
        $this->load('items');

        $this->update([
            'total_items' => $this->items->sum('quantity'),
            'sub_total' => $this->items->sum(function($item) {
                return $item->price * $item->quantity;
            }),
            'total' => $this->calculateFinalTotal()
        ]);
    }

    protected function calculateFinalTotal()
    {
        return $this->sub_total 
            + $this->shipping_cost 
            + $this->tax_amount 
            - $this->discount_amount;
    }
}
