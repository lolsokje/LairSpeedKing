<?php

namespace App\Models;

use App\Enums\LapTimeStatus;
use App\Traits\Snowflake;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LapTime extends Model
{
    use HasFactory, Snowflake;

    protected $hidden = [
        'updated_at',
    ];

    protected $appends = [
        'readable_lap_time',
        'status_text',
    ];

    protected $casts = [
        'status' => LapTimeStatus::class,
    ];

    public function lapTime(): Attribute
    {
        return Attribute::set(function ($value) {
            [$minutesAndSeconds, $millis] = explode('.', $value);
            [$minutes, $seconds] = explode(':', $minutesAndSeconds);

            return (int) $minutes * 60000 + (int) $seconds * 1000 + (int) $millis;
        });
    }

    public function readableLapTime(): Attribute
    {
        return Attribute::get(function () {
            $time = $this->lap_time;
            $minutes = (int) ($time / 60000) % 60;
            $seconds = str_pad((int) ($time / 1000) % 60, 2, '0', STR_PAD_LEFT);
            $millis = str_pad($time % 1000, 3, '0', STR_PAD_LEFT);

            return "$minutes:$seconds.$millis";
        });
    }

    public function statusText(): Attribute
    {
        return Attribute::get(function () {
            return ucfirst(strtolower($this->status->name));
        });
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', LapTimeStatus::SUBMITTED);
    }

    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
