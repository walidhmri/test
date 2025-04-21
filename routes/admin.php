<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;





Route::middleware(['auth', 'adminMiddleware','oualid-demo-actions'])->group(function () {

    //Les methodes get
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/Tickets', [TicketsController::class, 'index'])->name('admin.Tickets.list');
    Route::get('/admin/employee/edit/{id}', [AdminController::class, 'editEmployee'])->name('admin.employee.editemployee');
    Route::get('admin/profile/{id}', [ProfileController::class, 'index'])->name('admin.profile.show');
    Route::get('admin/profile/{id}/password-update', [ProfileController::class, 'indexpass'])->name('admin.profile.password');

    Route::get('/admin/tickets', [TicketsController::class, 'index'])->name('admin.Tickets.list');
    Route::get('/admin/employee', [AdminController::class, 'employee'])->name('admin.employee.list');
    Route::get('/admin/employee/edit/{id}', [AdminController::class, 'editEmployee'])->name('admin.employee.editemployee');
    Route::get('/admin/employee/ajouter', [AdminController::class, 'addEmployee'])->name('admin.employee.ajouter');
    Route::get('/admin/Tickets/{user_id}/{id}', [TicketsController::class, 'show'])->name('admin.Tickets.show');
    Route::get('/admin/ingenieur', [AdminController::class, 'ingenieur'])->name('admin.ingenieurs.list');
    Route::get('/admin/employee', [AdminController::class, 'employee'])->name('admin.employee.list');
    Route::get('/admin/faqs', [FaqsController::class, 'index'])->name('admin.faqs.list');
    Route::get('/admin/faqs/create', [FaqsController::class, 'cretae'])->name('admin.faq.create');
    Route::get('/admin/faqs/edit/{id}', [FaqsController::class, 'edit'])->name('admin.faq.edit');
    Route::get('/admin/Tickets/filter', [TicketsController::class, 'filter'])->name('admin.Tickets.filter');
    Route::get('/admin/Tickets/{id}', [TicketsController::class, 'idfill'])->name('admin.Tickets.fill');
    



    // patch methodes
    Route::patch('/admin/Tickets/update', [TicketsController::class, 'update'])->name('admin.Tickets.update');
    Route::patch('/admin/employee/update/{id}', [AdminController::class, 'updateEmployee'])->name('admin.employee.edit');
    Route::patch('/admin/faqs/update/{id}', [FaqsController::class, 'update'])->name('admin.faq.update');
    Route::patch('/admin/profile/{id}/password-update', [ProfileController::class, 'password'])->name('admin.profile.passwordupdate');






    Route::delete('/admin/employee', [AdminController::class, 'deleteEmployee'])->name('admin.employee.delete');
    Route::delete('/admin/Tickets/delete/{id}', [TicketsController::class, 'destroy'])->name('admin.Tickets.delete');
    Route::delete('/admin/faqs/delete/{id}', [FaqsController::class, 'destroy'])->name('admin.faq.delete');


    Route::post('/admin/employee/ajouter', [AdminController::class, 'storeEmployee'])->name('admin.employee.store');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('/admin/faqs/store', [FaqsController::class, 'store'])->name('admin.faq.store');



});

