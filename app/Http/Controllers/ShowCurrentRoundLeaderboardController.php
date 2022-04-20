<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Illuminate\Http\RedirectResponse;

class ShowCurrentRoundLeaderboardController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $round = Round::active()->first();

        if (!$round) {
            return back()->with('error', 'No active round');
        } else {
            return to_route('times.show', $round);
        }
    }
}
