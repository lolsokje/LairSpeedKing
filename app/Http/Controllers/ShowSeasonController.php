<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Inertia\Inertia;

class ShowSeasonController extends Controller
{
    public function __invoke(Season $season)
    {
        return Inertia::render('Seasons/Show', [
            'season' => $season,
            'active' => $season->rounds()->active()->with('car', 'variation.track')->first(),
            'pending' => $season->rounds()->pending()->with('car', 'variation.track')->get(),
            'completed' => $season->rounds()->completed()->with('car', 'variation.track')->get(),
        ]);
    }
}
