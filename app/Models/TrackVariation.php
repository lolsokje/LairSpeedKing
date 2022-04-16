<?php

namespace App\Models;

use App\Traits\Snowflake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrackVariation extends Model
{
    use HasFactory, Snowflake;

    public const DEFAULT_NAME = 'Base';

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
}
