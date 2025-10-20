<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'country_code',
        'method',
        'title',
        'description',
        'charge_title',
        'charge_amount',
        'charge_type',
        'discount_title',
        'discount_amount',
        'discount_type',
        'position',
        'status'
    ];

    protected $casts = [
        'charge_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'status' => 'boolean',
        'position' => 'integer'
    ];

    public function countryDetails()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }

    public function statuses()
    {
        return $this->hasMany('App\Models\PaymentMethodStatus', 'type', 'method');
    }
}
