<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\ChatController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;





Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //Route::get('/admin/employee/ajouter', [RegisteredUserController::class, 'create'])
    //->name('register');
    Route::get('admin/profile/{id}', [ProfileController::class, 'index'])->name('admin.profile.show');
    
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('/admin/tickets', [TicketsController::class, 'index'])->name('admin.tickets.list');
    Route::get('/admin/employee', [AdminController::class, 'employee'])->name('admin.employee.list');
    Route::get('/admin/employee/edit/{id}', [AdminController::class, 'editEmployee'])->name('admin.employee.editemployee');
    Route::patch('/admin/employee/update/{id}', [AdminController::class, 'updateEmployee'])->name('admin.employee.edit');
    Route::get('/admin/employee/ajouter', [AdminController::class, 'addEmployee'])->name('admin.employee.ajouter');
    Route::post('/admin/employee/ajouter', [AdminController::class, 'storeEmployee'])->name('admin.employee.store');
    Route::get('/admin',function(){ return redirect()->route('admin.dashboard');})->name('index');
    Route::delete('/admin/employee', [AdminController::class, 'deleteEmployee'])->name('admin.employee.delete');
    Route::delete('/admin/tickets/{id}', [TicketsController::class, 'destroy'])->name('admin.tickets.delete');
    Route::get('/admin/tickets/{user_id}/{id}', [TicketsController::class, 'show'])->name('admin.tickets.show');
    Route::post('/admin/tickets/filter', [TicketsController::class, 'filter'])->name('admin.tickets.filter');



    Route::patch('/admin/tickets/update', [TicketsController::class, 'update'])->name('admin.tickets.update');


});
