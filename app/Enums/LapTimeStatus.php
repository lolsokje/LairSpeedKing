<?php

namespace App\Enums;

enum LapTimeStatus: int
{
    case SUBMITTED = 0;
    case APPROVED = 1;
    case DENIED = 2;
    case UPDATED = 3;
}
