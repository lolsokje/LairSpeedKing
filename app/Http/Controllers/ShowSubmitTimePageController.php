<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Inertia\Inertia;

class ShowSubmitTimePageController extends Controller
{
    public function __invoke()
    {
        $round = Round::active()->with('season')->first();

        if (!$round) {
            return to_route('index');
        }

        return Inertia::render('Rounds/Times/Create', [
            'round' => $round,
        ]);
    }
}
