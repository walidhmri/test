<?php

use App\Http\Controllers\HomeController;
use App\Models\Faq;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocaleController;


Route::get('/', function () {
    $faqs=Faq::orderBy('created_at','desc')->paginate(5);
    return view('index',compact('faqs'));
});
Route::get('/contact-us', function () {
    return view('contact');
});
Route::get('/posts', function () {
    return view('posts');
});
Route::get('/faqs', [HomeController::class, 'home'])->name('faqs');

Route::get('locale/{language}', [LocaleController::class ,'setlocale'])->name('language.switch');

require __DIR__.'/user.php';
require __DIR__.'/ingenieur.php';
require __DIR__.'/admin.php';
require __DIR__.'/admin2.php';
require __DIR__.'/auth.php';

