<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartSetting extends Model
{
    public function countryDetails()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'short_name');
    }
}
