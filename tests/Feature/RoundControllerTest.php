<?php

use App\Models\Car;
use App\Models\Round;
use App\Models\Season;

use App\Models\TrackVariation;

use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function Pest\Laravel\travelTo;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

test('an admin can view the rounds index page', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->get(route('admin.seasons.rounds.index', [$season]))
        ->assertOk();
});

test('an unauthorized user cannot view the rounds index page', function () {
    $season = Season::factory()->create();

    get(route('admin.seasons.rounds.index', [$season]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.seasons.rounds.index', [$season]))
        ->assertRedirect(route('index'));
});

test('an admin can view the round create page', function () {
    $season = Season::factory()->create();
    actingAsAdmin()
        ->get(route('admin.seasons.rounds.create', [$season]))
        ->assertOk();
});

test('an unauthorized user cannot view the round create page', function () {
    $season = Season::factory()->create();

    get(route('admin.seasons.rounds.create', [$season]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.seasons.rounds.create', [$season]))
        ->assertRedirect(route('index'));
});

test('an admin can create a round', function () {
    $season = Season::factory()->create();

    actingAsAdmin()
        ->post(route('admin.seasons.rounds.store', [$season]), getRoundData());

    assertDatabaseCount('rounds', 1);
    assertCount(1, $season->rounds);
});

test('an unauthorized user cannot create a round', function () {
    $season = Season::factory()->create();

    post(route('admin.seasons.rounds.store', [$season]), getRoundData())
        ->assertRedirect(route('index'));

    actingAsUser()
        ->post(route('admin.seasons.rounds.store', [$season]), getRoundData())
        ->assertRedirect(route('index'));

    assertDatabaseCount('rounds', 0);
    assertCount(0, $season->rounds);
});

test('an admin can view the round edit page', function () {
    $round = Round::factory()->create();

    actingAsAdmin()
        ->get(route('admin.seasons.rounds.edit', [$round->season, $round]))
        ->assertOk();
});

test('an unauthorized user cannot view the round edit page', function () {
    $round = Round::factory()->create();

    get(route('admin.seasons.rounds.edit', [$round->season, $round]))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('admin.seasons.rounds.edit', [$round->season, $round]))
        ->assertRedirect(route('index'));
});

test('an admin can update a round', function () {
    $round = Round::factory()->create();

    actingAsAdmin()
        ->put(route('admin.seasons.rounds.update', [$round->season, $round]), getRoundData(['name' => 'New']))
        ->assertRedirect(route('admin.seasons.rounds.index', [$round->season]));

    assertEquals('New', $round->fresh()->name);
});

test('an unauthorized user cannot update a round', function () {
    $round = Round::factory()->create();
    $name = $round->name;

    put(route('admin.seasons.rounds.update', [$round->season, $round], getRoundData(['name' => 'New'])))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->put(route('admin.seasons.rounds.update', [$round->season, $round], getRoundData(['name' => 'New'])))
        ->assertRedirect(route('index'));

    assertEquals($name, $round->fresh()->name);
});

it('updates the season start and end date when adding a round', function () {
    $season = Season::factory()->create();
    assertNull($season->starts_at);
    assertNull($season->ends_at);

    actingAsAdmin();

    [$startsAt, $endsAt] = getStartsAndEndsAt('2022-01-01');

    post(route('admin.seasons.rounds.store', [$season]), getRoundData([
        'starts_at' => $startsAt,
        'ends_at' => $endsAt,
    ]));

    assertEquals($startsAt.' '.Round::START_TIME, $season->fresh()->starts_at);
    assertEquals($endsAt.' '.Round::END_TIME, $season->fresh()->ends_at);

    [$laterStartsAt, $laterEndsAt] = getStartsAndEndsAt('2022-01-08');

    post(route('admin.seasons.rounds.store', [$season]), getRoundData([
        'starts_at' => $laterStartsAt,
        'ends_at' => $laterEndsAt,
    ]));

    assertEquals($startsAt.' '.Round::START_TIME, $season->fresh()->starts_at);
    assertEquals($laterEndsAt.' '.Round::END_TIME, $season->fresh()->ends_at);

    [$earlierStartsAt, $earlierEndsAt] = getStartsAndEndsAt('2021-12-24');

    post(route('admin.seasons.rounds.store', [$season]), getRoundData([
        'starts_at' => $earlierStartsAt,
        'ends_at' => $earlierEndsAt,
    ]));

    assertEquals($earlierStartsAt.' '.Round::START_TIME, $season->fresh()->starts_at);
    assertEquals($laterEndsAt.' '.Round::END_TIME, $season->fresh()->ends_at);
});

it('shows the right amount of rounds on the round index page', function () {
    $season = Season::factory()->create();
    Round::factory(5)->for($season)->create();
    Round::factory(5)->for(Season::factory()->create());

    actingAsAdmin()
        ->get(route('admin.seasons.rounds.index', [$season]))
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Admin/Rounds/Index')
            ->has('rounds', 5)
        );
});

it('adds the correct start and end times to the start and end date', function () {
    $startsAt = '2022-01-01';
    $endsAt = '2022-01-08';
    $round = Round::factory()->create(['starts_at' => $startsAt, 'ends_at' => $endsAt]);

    assertEquals($startsAt.' '.Round::START_TIME, $round->starts_at);
    assertEquals($endsAt.' '.Round::END_TIME, $round->ends_at);
});

test('a round opens at the correct time', function () {
    [$startsAt, $endsAt] = getStartsAndEndsAt();
    $round = Round::factory()->create(['starts_at' => $startsAt, 'ends_at' => $endsAt]);

    $beforeStartsAt = (new DateTime($round->starts_at))->modify('-1 second');
    $onStartsAt = (new DateTime($round->starts_at));

    travelTo($beforeStartsAt);
    assertNull(Round::active()->first());

    travelTo($onStartsAt);
    assertNotNull(Round::active()->first());
});

test('a round closes at the correct time', function () {
    [$startsAt, $endsAt] = getStartsAndEndsAt();
    $round = Round::factory()->create(['starts_at' => $startsAt, 'ends_at' => $endsAt]);

    $onEndsAt = (new DateTime($round->ends_at));
    $afterEndsAt = (new DateTime($round->ends_at))->modify('+1 second');

    travelTo($onEndsAt);
    assertNotNull(Round::active()->first());

    travelTo($afterEndsAt);
    assertNull(Round::active()->first());
});

function getRoundData(?array $override = []): array
{
    [$startsAt, $endsAt] = getStartsAndEndsAt();
    return array_merge([
        'track_variation_id' => TrackVariation::factory()->create()->id,
        'car_id' => Car::factory()->create()->id,
        'name' => 'Test',
        'tla' => 'TST',
        'starts_at' => $startsAt,
        'ends_at' => $endsAt,
    ], $override);
}

function getStartsAndEndsAt(?string $startDate = 'now'): array
{
    $startsAt = new DateTime($startDate);
    $endsAt = (new DateTime($startDate))->modify('+1 week');

    return [
        $startsAt->format('Y-m-d'),
        $endsAt->format('Y-m-d'),
    ];
}
