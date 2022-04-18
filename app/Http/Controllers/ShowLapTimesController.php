<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Inertia\Inertia;
use Inertia\Response;

class ShowLapTimesController extends Controller
{
    public function __invoke(Round $round): Response
    {
        return Inertia::render('Rounds/Times/Show', [
            'round' => $round,
            'times' => $round->timesForLeaderboard(),
        ]);
    }
}
