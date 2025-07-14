<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    public function userDetail()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
