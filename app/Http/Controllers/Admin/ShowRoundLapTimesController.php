<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Round;
use App\Models\Season;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ShowRoundLapTimesController extends Controller
{
    public function __invoke(Request $request, Season $season, Round $round): Response
    {
        return Inertia::render('Admin/Rounds/Results/Index', [
            'season' => $season,
            'round' => $round,
            'times' => $round->times()
                ->orderBy('lap_time')
                ->with('user')
                ->get(),
        ]);
    }
}
