<?php

use App\Models\LapTime;
use App\Models\Round;

use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;
use function PHPUnit\Framework\assertEquals;

test('everyone can view the current leaderboard', function () {
    $round = Round::factory()->active()->create();
    LapTime::factory(3)->for($round)->approved()->create();

    get(route('leaderboard'))
        ->assertRedirect(route('times.show', [$round]));

    get(route('times.show', [$round]))
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Rounds/Times/Show')
            ->has('times', 3)
        );
});

test('times can only be submitted in active rounds', function () {
    actingAsUser()
        ->get(route('times.create'))
        ->assertRedirect(route('index'));

    // inactive
    Round::factory()->create(['starts_at' => '2020-01-01', 'ends_at' => '2020-01-08']);

    actingAsUser()
        ->get(route('times.create'))
        ->assertRedirect(route('index'));

    // active
    Round::factory()->active()->create();

    actingAsUser()
        ->get(route('times.create'))
        ->assertOk();
});

test('only authenticated users can submit laptimes', function () {
    Round::factory()->active()->create();

    get(route('times.create'))
        ->assertRedirect(route('index'));

    actingAsUser()
        ->get(route('times.create'))
        ->assertOk();
});

it('converts the submitted time to milliseconds', function () {
    $time = '1:09.420';
    $lapTime = LapTime::factory()->create(['lap_time' => $time]);

    assertEquals(69420, $lapTime->lap_time);
    assertEquals($time, $lapTime->readable_lap_time);

    $time = '1:69.420';
    $lapTime = LapTime::factory()->create(['lap_time' => $time]);

    assertEquals(129420, $lapTime->lap_time);
    assertEquals('2:09.420', $lapTime->readable_lap_time);
});

it('pads lap times correctly', function () {
    $times = [
        ['time' => '1:04.001', 'millis' => 64001],
        ['time' => '1:04.010', 'millis' => 64010],
        ['time' => '1:04.100', 'millis' => 64100],
        ['time' => '1:40.100', 'millis' => 100100],
    ];

    foreach ($times as $time) {
        $lapTime = LapTime::factory()->create(['lap_time' => $time['time']]);

        assertEquals($time['millis'], $lapTime->lap_time);
        assertEquals($time['time'], $lapTime->readable_lap_time);
    }
});
