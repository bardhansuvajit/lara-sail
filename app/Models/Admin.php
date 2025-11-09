<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_country_code',
        'phone_no',
        'gender_id',
        'username',
        'password',
        'profile_picture',
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

    /*
    // If using custom permission method (without Spatie)
    public function hasPermission($permission)
    {
        // Example: Check if admin has permission via roles
        if ($this->roles) {
            foreach ($this->roles as $role) {
                if ($role->permissions->contains('name', $permission)) {
                    return true;
                }
            }
        }
        return false;
    }
    */

    // If using Spatie package
    public function canAccess($permission)
    {
        return $this->hasPermissionTo($permission);
    }
}
