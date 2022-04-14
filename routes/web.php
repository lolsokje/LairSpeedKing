<?php

use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('index');

Route::get('/auth/discord/redirect', [DiscordController::class, 'redirect'])->name('auth.discord.redirect');
Route::get('/auth/discord/callback', [DiscordController::class, 'callback'])->name('auth.discord.callback');
Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('auth.logout');
