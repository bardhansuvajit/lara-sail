<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $fillable = ['method', 'title', 'subtitle', 'description', 'icon', 'cost', 'max_delivery_day'];

    public function countryDetails()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }
}
