<?php

namespace App\Models;

use App\Traits\DateRangeAttribute;
use App\Traits\Snowflake;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Round extends Model
{
    use HasFactory, Snowflake, DateRangeAttribute;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'status',
        'date_range',
    ];

    public function getStatusAttribute(): string
    {
        $start = $this->starts_at;
        $end = $this->ends_at;
        $today = date('Y-m-d');

        if ($today < $start) {
            return 'Pending';
        } elseif ($today > $end) {
            return 'Completed';
        } else {
            return 'Active';
        }
    }

    public function scopeActive(Builder $query): void
    {
        $today = date('Y-m-d');
        $query
            ->orderBy('starts_at')
            ->where('starts_at', '<=', $today)
            ->where('ends_at', '>=', $today);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function variation(): BelongsTo
    {
        return $this->belongsTo(TrackVariation::class, 'track_variation_id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
