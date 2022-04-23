<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointSystemCreateRequest;
use App\Models\Season;
use Inertia\Inertia;
use Inertia\Response;

class PointSystemController extends Controller
{
    public function index(Season $season): Response
    {
        return Inertia::render('Admin/Seasons/Points/Index', [
            'season' => $season->load('points'),
        ]);
    }

    public function create(Season $season): Response
    {
        return Inertia::render('Admin/Seasons/Points/Create', [
            'season' => $season->load('points'),
        ]);
    }

    public function store(PointSystemCreateRequest $request, Season $season)
    {
        $season->points()->delete();
        foreach ($request->get('positions') as $position) {
            $season->points()->create($position);
        }
        return redirect(route('admin.seasons.points.index', [$season]));
    }
}
