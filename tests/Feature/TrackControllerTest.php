<?php

use App\Enums\ContentType;

use App\Models\Track;

use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function PHPUnit\Framework\assertEquals;

test('an admin can view the admin track index page', function () {
    actingAsAdmin()
        ->get(route('admin.tracks.index'))
        ->assertOk();
});

test('unauthorized users cannot view the admin track index page', function () {
    get(route('admin.tracks.index'))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.tracks.index'))
        ->assertRedirect(route('index'));
});

test('an admin can view the create track page', function () {
    actingAsAdmin()
        ->get(route('admin.tracks.create'))
        ->assertOk();
});

test('unauthorized users cannot view the create track page', function () {
    get(route('admin.tracks.create'))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.cars.create'))
        ->assertRedirect(route('index'));
});

test('an admin can create tracks', function () {
    actingAsAdmin()
        ->post(route('admin.tracks.store', [
            'name' => 'Test',
            'content_type' => ContentType::BASE->value,
        ]))
        ->assertRedirect(route('admin.tracks.index'));

    assertDatabaseCount('tracks', 1);
});

test('unauthorized users cannot create tracks', function () {
    post(route('admin.tracks.store', [
        'name' => 'Test',
        'content_type' => ContentType::BASE->value,
    ]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->post(route('admin.tracks.store', [
            'name' => 'Test',
            'content_type' => ContentType::BASE->value,
        ]))
        ->assertRedirect(route('index'));

    assertDatabaseCount('tracks', 0);
});

test('a name and content type are required to create tracks', function () {
    actingAsAdmin()
        ->post(route('admin.tracks.store'))
        ->assertSessionHasErrors(['name' => 'The name field is required.'])
        ->assertSessionHasErrors(['content_type' => 'The content type field is required.']);
});

test('the content type must be valid', function () {
    actingAsAdmin()
        ->post(route('admin.tracks.store', [
            'name' => 'Test',
            'content_type' => 'Invalid',
        ]))
        ->assertSessionHasErrors(['content_type' => 'The selected content type is invalid.']);
});

test('an admin can view the track edit page', function () {
    $track = Track::factory()->create();

    actingAsAdmin()
        ->get(route('admin.tracks.edit', [$track]))
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Admin/Tracks/Edit')
            ->has('track', fn(Assert $page) => $page
                ->where('name', $track->name)
                ->etc()
            )
        );
});

test('an unauthorized user cannot view the track edit page', function () {
    $track = Track::factory()->create();

    get(route('admin.tracks.edit', [$track]))
        ->assertRedirect(route('index'));
});

test('an admin can update a track', function () {
    $track = Track::factory()->create();

    actingAsAdmin()
        ->put(route('admin.tracks.update', [$track]), [
            'name' => 'New',
            'content_type' => ContentType::BASE->value,
        ])
        ->assertRedirect(route('admin.tracks.index'));

    assertEquals('New', $track->fresh()->name);
});

test('an unauthorized user cannot update a track', function () {
    $track = Track::factory()->create();
    $name = $track->name;

    put(route('admin.tracks.update', [$track]), [
        'name' => 'New',
        'content_type' => ContentType::BASE->value,
    ])
        ->assertRedirect(route('index'));

    assertEquals($name, $track->fresh()->name);
});
