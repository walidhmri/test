<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\LocaleController;

Route::get('/', function () {
    return view('index');
});
Route::get('locale/{language}', [LocaleController::class ,'setlocale']);


require __DIR__.'/user.php';
require __DIR__.'/ingenieur.php';
require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
