<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackVariationCreateRequest;
use App\Models\Track;
use App\Models\TrackVariation;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TrackVariationController extends Controller
{
    public function index(Track $track): Response
    {
        return Inertia::render('Admin/Tracks/Variations/Index', [
            'track' => $track,
            'variations' => $track->variations,
        ]);
    }

    public function create(Track $track): Response
    {
        return Inertia::render('Admin/Tracks/Variations/Create', [
            'track' => $track,
        ]);
    }

    public function store(TrackVariationCreateRequest $request, Track $track): RedirectResponse
    {
        $track->variations()->create($request->validated());

        return to_route('admin.tracks.variations.index', [$track]);
    }

    public function edit(Track $track, TrackVariation $variation): Response
    {
        return Inertia::render('Admin/Tracks/Variations/Edit', [
            'track' => $track,
            'variation' => $variation,
        ]);
    }

    public function update(
        TrackVariationCreateRequest $request,
        Track $track,
        TrackVariation $variation,
    ): RedirectResponse {
        $variation->update($request->validated());

        return to_route('admin.tracks.variations.index', [$track]);
    }

    public function show(Track $track, $variation): Response
    {
        return Inertia::render('Admin/Tracks/Variations/Show', [
            'track' => $track,
            'variation' => $variation,
        ]);
    }
}
