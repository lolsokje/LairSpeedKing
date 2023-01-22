<?php

namespace App\Models;

use App\Traits\Snowflake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Snowflake;

    protected $hidden = [
        'discord_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'string',
        'discord_id' => 'string',
    ];

    public function times(): HasMany
    {
        return $this->hasMany(LapTime::class);
    }
}
