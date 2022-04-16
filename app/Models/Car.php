<?php

namespace App\Models;

use App\Enums\ContentType;
use App\Traits\ContentTypes;
use App\Traits\Snowflake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory, Snowflake, ContentTypes;

    protected $casts = [
        'content_type' => ContentType::class,
    ];

    protected $appends = [
        'content_type_name',
    ];
}
