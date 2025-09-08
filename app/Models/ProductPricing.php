<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPricing extends Model
{
    use SoftDeletes;

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }
}
