<?php

namespace App\Http\Controllers;

use App\Enums\ContentType;
use App\Http\Requests\TrackCreateRequest;
use App\Models\Track;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TrackController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Tracks/Index', [
            'tracks' => Track::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Tracks/Create', [
            'content_types' => ContentType::cases(),
        ]);
    }

    public function store(TrackCreateRequest $request): RedirectResponse
    {
        Track::create($request->validated());

        return to_route('admin.tracks.index');
    }

    public function show(Track $track): Response
    {
        return Inertia::render('Admin/Tracks/Show', [
            'track' => $track,
        ]);
    }

    public function edit(Track $track): Response
    {
        return Inertia::render('Admin/Tracks/Edit', [
            'track' => $track,
            'content_types' => ContentType::cases(),
        ]);
    }

    public function update(TrackCreateRequest $request, Track $track): RedirectResponse
    {
        $track->update($request->validated());

        return to_route('admin.tracks.index');
    }
}
