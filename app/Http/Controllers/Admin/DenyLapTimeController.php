<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LapTimeStatus;
use App\Http\Controllers\Controller;
use App\Models\LapTime;
use App\Models\Round;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;

class DenyLapTimeController extends Controller
{
    public function __invoke(Season $season, Round $round, LapTime $time): RedirectResponse
    {
        $time->update(['status' => LapTimeStatus::DENIED]);

        return back();
    }
}
