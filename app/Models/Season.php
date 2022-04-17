<?php

namespace App\Models;

use App\Traits\DateRangeAttribute;
use App\Traits\Snowflake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory, Snowflake, DateRangeAttribute;

    protected $appends = [
        'date_range',
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
}
