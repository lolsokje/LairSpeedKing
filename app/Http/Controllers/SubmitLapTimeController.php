<?php

namespace App\Http\Controllers;

use App\Http\Requests\LapTimeSubmitRequest;
use App\Models\Round;
use Illuminate\Http\RedirectResponse;

class SubmitLapTimeController extends Controller
{
    public function __invoke(LapTimeSubmitRequest $request): RedirectResponse
    {
        $activeRound = Round::active()->first();

        if (!$activeRound) {
            return to_route('times.create')->with(['error' => 'No active round.']);
        }

        $activeRound->times()->create(array_merge($request->validated(), [
            'user_id' => auth()->user()->id,
        ]));

        return to_route('times.show', [$activeRound]);
    }
}
