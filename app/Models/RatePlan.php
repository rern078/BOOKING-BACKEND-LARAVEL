<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RatePlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'name',
        'code',
        'description',
        'is_refundable',
        'min_nights',
        'max_nights',
        'cancellation_hours',
        'is_active',
    ];

    protected $casts = [
        'is_refundable' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function roomTypeRates(): HasMany
    {
        return $this->hasMany(RoomTypeRate::class);
    }
}

