<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;





Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //Route::get('/admin/employee/ajouter', [RegisteredUserController::class, 'create'])
    //->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('/admin/employee', [AdminController::class, 'employee'])->name('admin.employee.list');
    Route::get('/admin/employee/ajouter', [AdminController::class, 'addEmployee'])->name('admin.employee.ajouter');
    Route::post('/admin/employee/ajouter', [AdminController::class, 'storeEmployee'])->name('admin.employee.store');
    Route::get('/admin',function(){ return redirect()->route('admin.dashboard');})->name('index');
    Route::delete('/admin/employee', [AdminController::class, 'deleteEmployee'])->name('admin.employee.delete');

});
