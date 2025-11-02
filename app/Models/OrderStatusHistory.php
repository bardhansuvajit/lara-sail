<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderStatusHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'status',
        'previous_status',
        'notes',
        'show_in_frontend',
        'metadata',
        'actor_type',
        'actor_id',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
        'show_in_frontend' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the order that owns the status history.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the actor that created the status history.
     */
    public function actor(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope a query to only include statuses visible in frontend.
     */
    public function scopeVisibleInFrontend($query)
    {
        return $query->where('show_in_frontend', true);
    }

    /**
     * Scope a query for specific status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query for specific actor type.
     */
    public function scopeActorType($query, $actorType)
    {
        return $query->where('actor_type', $actorType);
    }

    /**
     * Get human readable status name.
     */
    public function getStatusNameAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    /**
     * Check if status is customer visible.
     */
    public function isVisibleToCustomer(): bool
    {
        return $this->show_in_frontend;
    }

    /**
     * Get metadata value by key.
     */
    public function getMetadataValue(string $key, $default = null)
    {
        return $this->metadata[$key] ?? $default;
    }

    /**
     * Set metadata value.
     */
    public function setMetadataValue(string $key, $value): void
    {
        $metadata = $this->metadata ?? [];
        $metadata[$key] = $value;
        $this->metadata = $metadata;
    }
}
