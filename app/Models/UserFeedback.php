<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFeedback extends Model
{
    use SoftDeletes;

    protected $table = 'user_feedback';

    protected $fillable = [
        'category',
        'first_name',
        'last_name',
        'email',
        'country_code',
        'primary_phone_no',
        'message',
        'page',
        'ip_address',
        'user_agent',
    ];
}
