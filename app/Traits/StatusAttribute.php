<?php

namespace App\Traits;

trait StatusAttribute
{
    public function getStatusAttribute(): string
    {
        $start = $this->starts_at;
        $end = $this->ends_at;
        $today = date('Y-m-d');

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
}
