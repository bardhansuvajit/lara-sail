<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBadgeCombination extends Model
{
    public function badgeDetail()
    {
        return $this->belongsTo('App\Models\ProductBadge', 'product_badge_id', 'id');
    }
}
