<?php

namespace App\Models;

use App\Enums\LapTimeStatus;
use App\Traits\DateRangeAttribute;
use App\Traits\Snowflake;
use App\Traits\StatusAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Round extends Model
{
    use HasFactory, Snowflake, DateRangeAttribute, StatusAttribute;

    public const START_TIME = '16:00:00';
    public const END_TIME = '15:59:45';

    protected $hidden = [
        'closes_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'status',
        'date_range',
    ];

    protected $casts = [
        'id' => 'string',
        'season_id' => 'string',
        'track_variation_id' => 'string',
        'car_id' => 'string',
    ];

    public function startsAt(): Attribute
    {
        return Attribute::set(fn ($value) => $value . ' ' . self::START_TIME);
    }

    public function endsAt(): Attribute
    {
        return Attribute::set(fn ($value) => $value . ' ' . self::END_TIME);
    }

    public function scopeActive(Builder $query): void
    {
        $now = now()->format('Y-m-d H:i:s');
        $query
            ->orderBy('starts_at')
            ->where('starts_at', '<=', $now)
            ->where('ends_at', '>=', $now);
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

    public function points(): Collection
    {
        return $this->season->points;
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
