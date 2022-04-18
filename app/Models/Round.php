<?php

namespace App\Models;

use App\Enums\LapTimeStatus;
use App\Traits\DateRangeAttribute;
use App\Traits\Snowflake;
use App\Traits\StatusAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Round extends Model
{
    use HasFactory, Snowflake, DateRangeAttribute, StatusAttribute;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'status',
        'date_range',
    ];

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

    public function times(): HasMany
    {
        return $this->hasMany(LapTime::class);
    }

    public function timesForLeaderboard(): array
    {
        $times = $this->times()
            ->with('user')
            ->orderBy('lap_time')
            ->where('status', LapTimeStatus::APPROVED)
            ->get();

        return $times->unique('user_id')->values()->toArray();
    }
}
