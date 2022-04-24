<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait StatusAttribute
{
    public function getStatusAttribute(): string
    {
        $start = $this->starts_at;
        $end = $this->ends_at;
        $today = date('Y-m-d H:i:s');

        if (!$start || !$end) {
            return 'Unknown';
        } elseif ($today < $start) {
            return 'Pending';
        } elseif ($today > $end) {
            return 'Completed';
        } else {
            return 'Active';
        }
    }

    public function scopePending(Builder $query): void
    {
        $query->orderBy('starts_at')->where('starts_at', '>', date('Y-m-d'))->orWhere('starts_at', null);
    }

    public function scopeActive(Builder $query): void
    {
        $today = date('Y-m-d');
        $query->orderBy('starts_at')->where('starts_at', '<=', $today)->where('ends_at', '>=', $today);
    }

    public function scopeCompleted(Builder $query): void
    {
        $query->orderBy('starts_at')->where('ends_at', '<', date('Y-m-d'));
    }
}
