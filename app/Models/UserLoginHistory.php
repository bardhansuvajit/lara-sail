<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLoginHistory extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'platform',
        'device_type',
        'device_brand',
        'device_model',
        'os_name',
        'os_version',
        'app_version',
        'browser',
        'browser_version',
        'latitude',
        'longitude',
        'ip_address',
        'city',
        'country',
        'is_active',
        'user_agent',
        'payload',
        'login_at',
        'last_activity_at',
        'expires_at',
        'logout_reason',
        'logout_at'
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'expires_at' => 'datetime',
        'logout_at' => 'datetime',
        'user_agent' => 'array',
        'payload' => 'array',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePlatform($query, $platform)
    {
        return $query->where('platform', $platform);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('login_at', '>=', now()->subDays($days));
    }

    public function markAsInactive(string $reason = null): void
    {
        $this->update([
            'is_active' => false,
            'logout_reason' => $reason,
            'logout_at' => now()
        ]);
    }

    public function updateLastActivity(): void
    {
        $this->update(['last_activity_at' => now()]);
    }

    public function getLocationAttribute(): ?string
    {
        if ($this->city && $this->country) {
            return "{$this->city}, {$this->country}";
        }
        
        return $this->ip_address;
    }

    public function getDeviceInfoAttribute(): string
    {
        $parts = array_filter([
            $this->device_brand,
            $this->device_model,
            $this->os_name,
            $this->os_version ? "v{$this->os_version}" : null
        ]);

        return implode(' · ', $parts) ?: 'Unknown Device';
    }
}
