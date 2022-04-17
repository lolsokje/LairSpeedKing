<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoundCreateRequest;
use App\Models\Car;
use App\Models\Round;
use App\Models\Season;
use App\Models\Track;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class RoundController extends Controller
{
    public function index(Season $season): Response
    {
        return Inertia::render('Admin/Rounds/Index', [
            'season' => $season,
            'rounds' => $season->rounds()->orderBy('starts_at')->with('car', 'variation.track')->get(),
        ]);
    }

    public function create(Season $season): Response
    {
        return Inertia::render('Admin/Rounds/Create', [
            'season' => $season,
            'tracks' => Track::query()->orderBy('name')->with('variations')->get(),
            'cars' => Car::query()->orderBy('name')->get(),
        ]);
    }

    public function store(RoundCreateRequest $request, Season $season): RedirectResponse
    {
        $season->rounds()->create($request->validated());

        $season->setStartAndEndDate();

        return to_route('admin.seasons.rounds.index', [$season]);
    }

    public function show()
    {
        //
    }

    public function edit(Season $season, Round $round): Response
    {
        return Inertia::render('Admin/Rounds/Edit', [
            'season' => $season,
            'round' => $round->load('variation.track'),
            'tracks' => Track::query()->orderBy('name')->with('variations')->get(),
            'cars' => Car::query()->orderBy('name')->get(),
        ]);
    }

    public function update(RoundCreateRequest $request, Season $season, Round $round): RedirectResponse
    {
        $round->update($request->validated());

        $season->setStartAndEndDate();

        return to_route('admin.seasons.rounds.index', [$season]);
    }
}
