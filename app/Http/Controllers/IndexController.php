<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Index', [
            'active' => Season::active()->withCount('rounds')->first(),
            'pending' => Season::pending()->withCount('rounds')->get(),
            'completed' => Season::completed()->withCount('rounds')->get(),
        ]);
    }
}
