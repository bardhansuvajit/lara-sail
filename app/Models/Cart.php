<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

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
