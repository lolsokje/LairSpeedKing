<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Inertia\Inertia;

class AdminIndexController extends Controller
{
    public function __invoke()
    {
        $round = Round::active()->first();
        return Inertia::render('Admin/Index', [
            'season' => $round?->season,
            'round' => $round,
        ]);
    }
}
