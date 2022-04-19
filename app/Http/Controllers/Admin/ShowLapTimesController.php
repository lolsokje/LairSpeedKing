<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LapTime;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowLapTimesController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Admin/Times/Index', [
            'times' => LapTime::with('user', 'round.variation.track', 'round.car', 'round.season')->get(),
        ]);
    }
}
