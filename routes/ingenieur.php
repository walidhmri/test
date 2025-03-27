<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ingenieur\ProfileController;







Route::middleware(['auth', 'ingenieurMiddleware'])->group(function () {
    Route::get('/ingenieur/dashboard', function () {
        return view('ingenieur.dashboard');
    })->name('ingenieur.dashboard');
    Route::get('ingenieur/profile', [ProfileController::class, 'index'])->name('ingenieur.profile.show');
    Route::get('ingenieur/settings', [ProfileController::class, 'update'])->name('ingenieur.profile.update');
    

});