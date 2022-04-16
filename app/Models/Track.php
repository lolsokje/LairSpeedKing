<?php

namespace App\Models;

use App\Enums\ContentType;
use App\Traits\Snowflake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Track extends Model
{
    use HasFactory, Snowflake;

    protected $casts = [
        'content_type' => ContentType::class,
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function variations(): HasMany
    {
        return $this->hasMany(TrackVariation::class);
    }
}
