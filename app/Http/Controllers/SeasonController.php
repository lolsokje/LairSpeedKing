<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonCreateRequest;
use App\Http\Requests\SeasonUpdateRequest;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SeasonController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Seasons/Index', [
            'seasons' => Season::query()
                               ->orderBy('starts_at')
                               ->withCount('rounds')
                               ->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Seasons/Create');
    }

    public function store(SeasonCreateRequest $request): RedirectResponse
    {
        Season::create($request->validated());

        return to_route('admin.seasons.index');
    }

    public function show(Season $season): Response
    {
        return Inertia::render('Admin/Seasons/Show', [
            'season' => $season->load('rounds'),
        ]);
    }

    public function edit(Season $season): Response
    {
        return Inertia::render('Admin/Seasons/Edit', [
            'season' => $season,
        ]);
    }

    public function update(SeasonUpdateRequest $request, Season $season): RedirectResponse
    {
        $season->update($request->validated());

        return to_route('admin.seasons.index');
    }
}
