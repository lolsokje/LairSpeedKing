<?php

use App\Models\LapTime;

use function PHPUnit\Framework\assertEquals;

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
