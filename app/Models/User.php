<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country_id',
        'primary_phone_no',
        'gender_id',
        'password',
        'alt_phone_no',
        'date_of_birth',
        'profile_picture',
        'is_blacklisted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function shippingAddresses()
    {
        return $this->hasMany('App\Models\UserAddress', 'user_id', 'id')->where('address_type', 'shipping')->orderBy('is_default', 'desc')->orderBy('id', 'desc');
    }

    public function billingAddresses()
    {
        return $this->hasMany('App\Models\UserAddress', 'user_id', 'id')->where('address_type', 'billing')->orderBy('is_default', 'desc')->orderBy('id', 'desc');
    }
}
