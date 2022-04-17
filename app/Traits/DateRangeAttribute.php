<?php

namespace App\Traits;

use DateTime;

trait DateRangeAttribute
{
    public function getDateRangeAttribute(): string
    {
        $format = 'F jS Y';
        $startsAt = $this->starts_at;
        $endsAt = $this->ends_at;
        $start = $startsAt ? DateTime::createFromFormat('Y-m-d', $startsAt)->format($format) : null;
        $end = $endsAt ? DateTime::createFromFormat('Y-m-d', $endsAt)->format($format) : null;

        if (!$start || !$end) {
            return '';
        }
        return "$start - $end";
    }
}
