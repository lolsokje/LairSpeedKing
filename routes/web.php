<?php

use App\Http\Controllers\AdminIndexController;
use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\TrackVariationController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('index');

Route::get('/auth/discord/redirect', [DiscordController::class, 'redirect'])->name('auth.discord.redirect');
Route::get('/auth/discord/callback', [DiscordController::class, 'callback'])->name('auth.discord.callback');
Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('auth.logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
    Route::get('', AdminIndexController::class)->name('index');

    Route::resource('tracks', TrackController::class)->except('destroy');
    Route::resource('cars', CarController::class)->except('destroy');

    Route::group(['prefix' => 'tracks/{track}', 'as' => 'tracks.'], function () {
        Route::resource('variations', TrackVariationController::class)->except('destroy');
    });
});
