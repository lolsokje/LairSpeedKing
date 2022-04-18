<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Inertia\Inertia;

class ShowSubmitTimePageController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Rounds/Times/Create', [
            'round' => Round::active()->with('season')->first(),
        ]);
    }
}
