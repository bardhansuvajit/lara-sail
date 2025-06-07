<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public function countryDetail()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }

    public function stateDetail()
    {
        return $this->belongsTo('App\Models\State', 'state', 'code');
    }
}
