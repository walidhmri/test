<?php
use App\Http\Controllers\AdminController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;






Route::middleware(['auth', 'ingenieurMiddleware'])->group(function () {
    Route::get('/ingenieur/dashboard', function () {
        return view('ingenieur.dashboard');
    })->name('ingenieur.dashboard');
});