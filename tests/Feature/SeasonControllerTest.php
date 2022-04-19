<?php

use App\Models\Season;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function PHPUnit\Framework\assertEquals;

test('an admin can view the season index page', function () {
    actingAsAdmin()
        ->get(route('admin.seasons.index'))
        ->assertOk();
});

test('an unauthorized user cannot view the season index page', function () {
    get(route('admin.seasons.index'))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.seasons.index'))
        ->assertRedirect(route('index'));
});

test('an admin can see the create season page', function () {
    actingAsAdmin()
        ->get(route('admin.seasons.create'))
        ->assertOk();
});

test('an unauthorized user cannot see the create season page', function () {
    get(route('admin.seasons.create'))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.seasons.create'))
        ->assertRedirect(route('index'));
});

test('an admin can create a season', function () {
    actingAsAdmin()
        ->post(route('admin.seasons.store'), [
            'name' => 'Test',
        ])
        ->assertRedirect(route('admin.seasons.index'));

    assertDatabaseCount('seasons', 1);
});

test('an unauthorized user cannot create a season', function () {
    post(route('admin.seasons.store'), [
        'name' => 'Test',
    ])
        ->assertRedirect(route('index'));

    actingAsUser()
        ->post(route('admin.seasons.store'), [
            'name' => 'Test',
        ])
        ->assertRedirect(route('index'));

    assertDatabaseCount('seasons', 0);
});

it('shows the correct amount of seasons on the season index page', function () {
    Season::factory(3)->create();

    actingAsAdmin()
        ->get(route('admin.seasons.index'))
        ->assertInertia(fn(Assert $page) => $page
            ->component('Admin/Seasons/Index')
            ->has('seasons', 3)
        );
});

test('an admin can view the season edit page', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->get(route('admin.seasons.edit', [$season]))
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Admin/Seasons/Edit')
            ->has('season')
            ->where('season.name', $season->name)
        );
});

test('an unauthorized user can not view the season edit page', function () {
    $season = Season::factory()->create();

    get(route('admin.seasons.edit', [$season]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.seasons.edit', [$season]))
        ->assertRedirect(route('index'));
});

test('an admin can update a season', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->put(route('admin.seasons.update', [$season]), [
            'name' => 'New',
        ])
        ->assertRedirect(route('admin.seasons.index'));

    assertEquals('New', $season->fresh()->name);
});

test('an unauthorized user cannot update a season', function () {
    $season = Season::factory()->create();
    $name = $season->name;

    put(route('admin.seasons.update', [$season]), [
        'name' => 'New',
    ])
        ->assertRedirect(route('index'));

    actingAsUser()
        ->put(route('admin.seasons.update', [$season]), [
            'name' => 'New',
        ])
        ->assertRedirect(route('index'));

    assertEquals($name, $season->fresh()->name);
});
