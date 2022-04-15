<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

use Illuminate\Foundation\Testing\TestCase;

use function Pest\Laravel\actingAs;

uses(Tests\TestCase::class, LazilyRefreshDatabase::class)->in('Feature', 'Unit');

function createUser(): User
{
    return User::factory()->create();
}

function createAdmin(): User
{
    return User::factory()->admin()->create();
}

function actingAsUser(): TestCase
{
    return actingAs(createUser());
}

function actingAsAdmin(): TestCase
{
    return actingAs(createAdmin());
}
