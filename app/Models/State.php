<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_code',
        'name',
        'code',
        'type',
        'zone',
        'capital',
        'population',
        'area',
        'language',
        'shipping_availability',
        'cash_on_delivery_availability',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }

    public function cities()
    {
        return $this->hasMany('App\Models\City', 'state_code', 'id');
    }
}
