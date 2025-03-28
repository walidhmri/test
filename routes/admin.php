<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;





Route::middleware(['auth', 'adminMiddleware'])->group(function () {

    //Les methodes get
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/tickets', [TicketsController::class, 'index'])->name('admin.tickets.list');
    Route::get('/admin/employee/edit/{id}', [AdminController::class, 'editEmployee'])->name('admin.employee.editemployee');
    Route::get('admin/profile/{id}', [ProfileController::class, 'index'])->name('admin.profile.show');
    Route::get('/admin/tickets', [TicketsController::class, 'index'])->name('admin.tickets.list');
    Route::get('/admin/employee', [AdminController::class, 'employee'])->name('admin.employee.list');
    Route::get('/admin/employee/edit/{id}', [AdminController::class, 'editEmployee'])->name('admin.employee.editemployee');
    Route::get('/admin/employee/ajouter', [AdminController::class, 'addEmployee'])->name('admin.employee.ajouter');
    Route::get('/admin/tickets/{user_id}/{id}', [TicketsController::class, 'show'])->name('admin.tickets.show');
    Route::get('/admin/ingenieur', [AdminController::class, 'ingenieur'])->name('admin.ingenieurs.list');
    Route::get('/admin/employee', [AdminController::class, 'employee'])->name('admin.employee.list');




    // patch methodes
    Route::patch('/admin/tickets/update', [TicketsController::class, 'update'])->name('admin.tickets.update');
    Route::patch('/admin/employee/update/{id}', [AdminController::class, 'updateEmployee'])->name('admin.employee.edit');

    Route::delete('/admin/employee', [AdminController::class, 'deleteEmployee'])->name('admin.employee.delete');
    Route::delete('/admin/tickets/delete/{id}', [TicketsController::class, 'destroy'])->name('admin.tickets.delete');


    Route::post('/admin/tickets/filter', [TicketsController::class, 'filter'])->name('admin.tickets.filter');
    Route::post('/admin/employee/ajouter', [AdminController::class, 'storeEmployee'])->name('admin.employee.store');
    Route::post('register', [RegisteredUserController::class, 'store']);




});
