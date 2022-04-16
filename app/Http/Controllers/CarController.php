<?php

namespace App\Http\Controllers;

use App\Enums\ContentType;
use App\Http\Requests\ContentCreateRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CarController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cars/Index', [
            'cars' => Car::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cars/Create', [
            'content_types' => ContentType::cases(),
        ]);
    }

    public function store(ContentCreateRequest $request): RedirectResponse
    {
        Car::create($request->validated());

        return to_route('admin.cars.index');
    }

    public function show(Car $car): Response
    {
        return Inertia::render('Admin/Cars/Show', [
            'car' => $car,
        ]);
    }

    public function edit(Car $car): Response
    {
        return Inertia::render('Admin/Cars/Edit', [
            'car' => $car,
            'content_types' => ContentType::cases(),
        ]);
    }

    public function update(ContentCreateRequest $request, Car $car): RedirectResponse
    {
        $car->update($request->validated());

        return to_route('admin.cars.index');
    }
}
