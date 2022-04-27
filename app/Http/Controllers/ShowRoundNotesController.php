<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Inertia\Inertia;
use Inertia\Response;

class ShowRoundNotesController extends Controller
{
    public function __invoke(Round $round): Response
    {
        return Inertia::render('Rounds/Notes', [
            'round' => $round->load('season:id,name'),
        ]);
    }
}
