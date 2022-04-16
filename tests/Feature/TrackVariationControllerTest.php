<?php

use App\Enums\ContentType;
use App\Models\Track;
use App\Models\TrackVariation;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

test('an admin can view the variation index page', function () {
    $track = Track::factory()->create();

    actingAsAdmin()
        ->get(route('admin.tracks.variations.index', [$track]))
        ->assertOk();
});

test('unauthorized users cannot view the variation index page', function () {
    $track = Track::factory()->create();

    get(route('admin.tracks.variations.index', [$track]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.tracks.variations.index', [$track]))
        ->assertRedirect(route('index'));
});

test('an admin can view the variation create page', function () {
    $track = Track::factory()->create();

    actingAsAdmin()
        ->get(route('admin.tracks.variations.create', [$track]))
        ->assertOk();
});

test('unauthorized users cannot view the variation create page', function () {
    $track = Track::factory()->create();

    get(route('admin.tracks.variations.index', [$track]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.tracks.variations.create', [$track]))
        ->assertRedirect(route('index'));
});

test('an admin can create track variations', function () {
    $track = Track::factory()->create();

    actingAsAdmin()
        ->post(route('admin.tracks.variations.store', [$track]), [
            'name' => 'Test'
        ])
        ->assertRedirect(route('admin.tracks.variations.index', [$track]));

    assertDatabaseCount('track_variations', 1);
    assertCount(1, $track->variations);
});

test('an unauthorized user cannot create track variations', function () {
    $track = Track::factory()->create();

    post(route('admin.tracks.variations.store', [$track]), [
        'name' => 'Test'
    ])
        ->assertRedirect(route('index'));

    actingAsUser()
        ->post(route('admin.tracks.variations.store', [$track]), [
            'name' => 'Test'
        ])
        ->assertRedirect(route('index'));

    assertDatabaseCount('track_variations', 0);
    assertCount(0, $track->variations);
});

test('a variation name is required', function () {
    $track = Track::factory()->create();

    actingAsAdmin()
        ->post(route('admin.tracks.variations.store', [$track]))
        ->assertSessionHasErrors(['name' => 'The name field is required.']);
});

test('an admin can view the variation edit page', function () {
    $variation = TrackVariation::factory()->create();

    actingAsAdmin()
        ->get(route('admin.tracks.variations.index', [$variation->track, $variation]))
        ->assertOk();
});

test('unauthorized users cannot view the variation edit page', function () {
    $variation = TrackVariation::factory()->create();

    get(route('admin.tracks.variations.index', [$variation->track, $variation]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.tracks.variations.index', [$variation->track, $variation]))
        ->assertRedirect(route('index'));
});

test('an admin can update a variation', function () {
    $variation = TrackVariation::factory()->create();

    actingAsAdmin()
        ->put(route('admin.tracks.variations.update', [$variation->track, $variation]), [
            'name' => 'New'
        ])
        ->assertRedirect(route('admin.tracks.variations.index', [$variation->track]));

    assertEquals('New', $variation->fresh()->name);
});

test('an unauthorized user cannot update a variation', function () {
    $variation = TrackVariation::factory()->create();
    $name = $variation->name;

    put(route('admin.tracks.variations.update', [$variation->track, $variation]), [
        'name' => 'New'
    ])
        ->assertRedirect(route('index'));

    actingAsUser()
        ->put(route('admin.tracks.variations.update', [$variation->track, $variation]), [
            'name' => 'New',
        ])
        ->assertRedirect(route('index'));

    assertEquals($name, $variation->fresh()->name);
});

it('creates a variation when a new track is created', function () {
    actingAsAdmin()
        ->post(route('admin.tracks.store', [
            'name' => 'Test',
            'content_type' => ContentType::BASE->value
        ]));

    $track = Track::first();

    assertDatabaseCount('track_variations', 1);
    assertCount(1, $track->variations);
    assertEquals(TrackVariation::DEFAULT_NAME, $track->variations->first()->name);
});
