<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'device_id','user_id','currency_code','total_items','sub_total','total',
        'coupon_code_id','coupon_code','discount_amount','discount_type','shipping_method_id',
        'shipping_cost','tax_amount','tax_type','tax_details','last_activity_at',
        'abandoned_at','is_abandoned','reminder_count','converted_to_order_at',
        'order_id','status'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id', 'id')->where('is_saved_for_later', 0)->orderBy('id', 'desc');
    }

    public function savedItems()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id', 'id')->where('is_saved_for_later', 1)->orderBy('id', 'desc');
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
