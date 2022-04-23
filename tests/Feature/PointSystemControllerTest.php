<?php

use App\Models\Season;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertCount;

test('an admin can view the point position index page', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->get(route('admin.seasons.points.index', [$season]))
        ->assertOk();
});

test('an unauthorized user cannot view the point position index page', function () {
    $season = Season::factory()->create();

    get(route('admin.seasons.points.index', [$season]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.seasons.points.index', [$season]))
        ->assertRedirect(route('index'));
});

test('an admin can view the point position create page', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->get(route('admin.seasons.points.create', [$season]))
        ->assertOk();
});

test('an unauthorized user cannot view the point position create page', function () {
    $season = Season::factory()->create();

    get(route('admin.seasons.points.create', [$season]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.seasons.points.create', [$season]))
        ->assertRedirect(route('index'));
});

test('an admin can create a points system', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->post(route('admin.seasons.points.store', [$season]), getPointsSystem())
        ->assertRedirect(route('admin.seasons.points.index', [$season]));

    assertDatabaseCount('point_systems', 5);
    assertCount(5, $season->points);
});

test('at least one position is needed when creating a point system', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->post(route('admin.seasons.points.store', [$season]))
        ->assertSessionHasErrors(['positions' => 'The positions field is required.']);

    post(route('admin.seasons.points.store', [$season]), [
        'positions' => [[]],
    ])
        ->assertSessionHasErrors(['positions' => 'You must provide at least one position.']);
});

test('each provided position must be unique in the positions array', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->post(route('admin.seasons.points.store', [$season]), [
            'positions' => [
                ['position' => 1, 'points' => 10],
                ['position' => 1, 'points' => 8],
            ]
        ])
        ->assertSessionHasErrors(['positions' => 'The provided positions must be unique.']);
});

it('removes the old points system before storing a new one', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->post(route('admin.seasons.points.store', [$season]), getPointsSystem());
    assertDatabaseCount('point_systems', 5);

    actingAsAdmin()
        ->post(route('admin.seasons.points.store', [$season]), getPointsSystem());
    assertDatabaseCount('point_systems', 5);

    $seasonTwo = Season::factory()->create();

    actingAsAdmin()
        ->post(route('admin.seasons.points.store', [$seasonTwo]), getPointsSystem());
    assertDatabaseCount('point_systems', 10);
});

test('an unauthorized user cannot create a points system', function () {
    $season = Season::factory()->create();
    post(route('admin.seasons.points.store', [$season]), getPointsSystem())
        ->assertRedirect(route('index'));

    actingAsUser()
        ->post(route('admin.seasons.points.store', [$season]), getPointsSystem())
        ->assertRedirect(route('index'));

    assertDatabaseCount('point_systems', 0);
    assertCount(0, $season->points);
});

function getPointsSystem(): array
{
    return [
        'positions' => [
            ['position' => 1, 'points' => 10],
            ['position' => 2, 'points' => 8],
            ['position' => 3, 'points' => 6],
            ['position' => 4, 'points' => 4],
            ['position' => 5, 'points' => 2],
        ]
    ];
}
