<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('a guest cannot view the admin panel', function () {
    get(route('admin.index'))
        ->assertRedirect(route('index'));
});

test('a normal user cannot view the admin panel', function () {
    actingAs(createUser())
        ->get(route('admin.index'))
        ->assertRedirect(route('index'));
});

test('an admin can view the admin panel', function () {
    actingAs(createAdmin())
        ->get(route('admin.index'))
        ->assertOk();
});
