<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\InicioController;

require_once __DIR__ . '/fortify.php';

Route::get('/', InicioController::class)->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
