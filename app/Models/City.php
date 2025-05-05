<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'country_id',
        'state_id',
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
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }
}
