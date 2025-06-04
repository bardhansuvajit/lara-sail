<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    public function countryDetails()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'short_name');
    }
}
