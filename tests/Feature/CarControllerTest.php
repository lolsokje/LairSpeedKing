<?php

use App\Enums\ContentType;

use App\Models\Car;

use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function PHPUnit\Framework\assertEquals;

test('an admin can view the admin car index page', function () {
    actingAsAdmin()
        ->get(route('admin.cars.index'))
        ->assertOk();
});

test('unauthorized users cannot view the admin car index page', function () {
    get(route('admin.cars.index'))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.cars.index'))
        ->assertRedirect(route('index'));
});

test('an admin can view the create car page', function () {
    actingAsAdmin()
        ->get(route('admin.cars.create'))
        ->assertOk();
});

test('unauthorized users cannot view the create car page', function () {
    get(route('admin.cars.create'))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.cars.create'))
        ->assertRedirect(route('index'));
});

test('an admin can create cars', function () {
    actingAsAdmin()
        ->post(route('admin.cars.store', [
            'name' => 'Test',
            'content_type' => ContentType::BASE->value,
        ]))
        ->assertRedirect(route('admin.cars.index'));

    assertDatabaseCount('cars', 1);
});

test('unauthorized users cannot create cars', function () {
    post(route('admin.cars.store', [
        'name' => 'Test',
        'content_type' => ContentType::BASE->value,
    ]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->post(route('admin.cars.store', [
            'name' => 'Test',
            'content_type' => ContentType::BASE->value,
        ]))
        ->assertRedirect(route('index'));

    assertDatabaseCount('cars', 0);
});

test('a name and content type are required to create cars', function () {
    actingAsAdmin()
        ->post(route('admin.cars.store'))
        ->assertSessionHasErrors(['name' => 'The name field is required.'])
        ->assertSessionHasErrors(['content_type' => 'The content type field is required.']);
});

test('the content type must be valid', function () {
    actingAsAdmin()
        ->post(route('admin.cars.store', [
            'name' => 'Test',
            'content_type' => 'Invalid',
        ]))
        ->assertSessionHasErrors(['content_type' => 'The selected content type is invalid.']);
});

test('an admin can view the car edit page', function () {
    $car = Car::factory()->create();

    actingAsAdmin()
        ->get(route('admin.cars.edit', [$car]))
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Admin/Cars/Edit')
            ->has('car', fn(Assert $page) => $page
                ->where('name', $car->name)
                ->etc()
            )
        );
});

test('an unauthorized user cannot view the car edit page', function () {
    $car = Car::factory()->create();

    get(route('admin.cars.edit', [$car]))
        ->assertRedirect(route('index'));
});

test('an admin can update a car', function () {
    $car = Car::factory()->create();

    actingAsAdmin()
        ->put(route('admin.cars.update', [$car]), [
            'name' => 'New',
            'content_type' => ContentType::BASE->value,
        ])
        ->assertRedirect(route('admin.cars.index'));

    assertEquals('New', $car->fresh()->name);
});

test('an unauthorized user cannot update a car', function () {
    $car = Car::factory()->create();
    $name = $car->name;

    put(route('admin.cars.update', [$car]), [
        'name' => 'New',
        'content_type' => ContentType::BASE->value,
    ])
        ->assertRedirect(route('index'));

    assertEquals($name, $car->fresh()->name);
});
