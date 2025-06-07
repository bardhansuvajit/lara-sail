<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'country_code',
        'state_code',
        'name',
        'district',
        'postal_code',
        'latitude',
        'longitude',
        'language',
        'shipping_availability',
        'cash_on_delivery_availability',
        'status',
    ];    

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_code', 'id');
    }
}
