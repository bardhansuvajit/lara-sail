<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cart_id','product_id','product_variation_id','product_name','variation_attributes',
        'sku','selling_price','mrp','quantity','total','is_available','availability_message',
        'options','custom_fields','status'
    ];

    public function updateAvailabilityMessage()
    {
        $this->availability_message = $this->generateStockMessage();
        $this->save();
    }

    protected function generateStockMessage()
    {
        if ($this->product->is_discontinued) {
            return __('Discontinued');
        }

        if ($this->product->is_preorder) {
            return __('Pre-order - ships :date', ['date' => $this->product->preorder_date]);
        }

        if ($this->product->stock_qty <= 0) {
            return $this->product->is_backorderable 
                ? __('Backordered - ships in :days days', ['days' => 7])
                : __('Out of stock');
        }

        return $this->product->stock_qty <= 5
            ? __('Only :quantity left!', ['quantity' => $this->product->stock_qty])
            : __('In stock');
    }
}
