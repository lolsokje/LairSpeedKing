<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AdminIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Admin/Index');
    }
}
