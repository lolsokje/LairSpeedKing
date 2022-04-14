<?php

namespace App\Traits;

trait Snowflake
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $key = resolve('snowflake')->id();
                $model->{$model->getKeyName()} = $key;
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }
}
