<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Services\SeasonStandingsService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowStandingsController extends Controller
{
    public function __invoke(Season $season, SeasonStandingsService $seasonStandingsService)
    {
        return Inertia::render('Seasons/Standings', [
            'season' => $season->load('rounds'),
            'standings' => $seasonStandingsService->getStandings($season),
        ]);
    }
}
