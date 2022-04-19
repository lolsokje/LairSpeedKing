<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Round;
use App\Models\Season;
use Inertia\Inertia;
use Inertia\Response;

class ShowPendingLapTimesController extends Controller
{
    public function __invoke(Season $season, Round $round): Response
    {
        return Inertia::render('Admin/Rounds/Results/Index', [
            'season' => $season,
            'round' => $round,
            'times' => $round->times()->pending()->with('user')->get(),
        ]);
    }
}
