<?php

namespace App\Models;

use App\Traits\DateRangeAttribute;
use App\Traits\Snowflake;
use App\Traits\StatusAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Season extends Model
{
    use HasFactory, Snowflake, DateRangeAttribute, StatusAttribute;

    protected $appends = [
        'date_range',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function setStartAndEndDate()
    {
        $firstRound = $this->rounds()->orderBy('starts_at')->first();
        $lastRound = $this->rounds()->orderBy('ends_at', 'desc')->first();

        $this->update([
            'starts_at' => $firstRound?->starts_at,
            'ends_at' => $lastRound?->ends_at,
        ]);
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class);
    }

    public function points(): HasMany
    {
        return $this->hasMany(PointSystem::class)->orderBy('position');
    }

    public function times(): HasManyThrough
    {
        return $this->hasManyThrough(LapTime::class, Round::class);
    }
}
