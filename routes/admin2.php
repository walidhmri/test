<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\SolutionsController;
use App\Http\Controllers\Admin\TicketsController;
use Illuminate\Support\Facades\Route;





Route::middleware(['auth', 'adminMiddleware','oualid-demo-actions'])->group(function () {

 Route::get('/admin/Tickets/{user_id}/{id}/solve', [SolutionsController::class, 'index'])->name('admin.Tickets.solve');
 Route::get('admin/departments', [DepartmentController::class, 'index'])->name('admin.department.list');
 Route::get('admin/departments/create', [DepartmentController::class, 'create'])->name('admin.department.create');
 Route::get('admin/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('admin.department.edit');
 


 Route::post('admin/departments/store', [DepartmentController::class, 'store'])->name('admin.department.store');
 Route::post('admin/departments/{id}/update', [DepartmentController::class, 'update'])->name('admin.department.update');
 Route::delete('admin/departments/{id}/delete', [DepartmentController::class, 'destroy'])->name('admin.department.delete');
Route::delete('admin/Tickets/solution/{id}/delete', [SolutionsController::class, 'destroy'])->name('admin.Ticket.solve.delete');


 Route::post('/admin/Ticket/{id}/solve', [SolutionsController::class, 'store'])->name('admin.Ticket.solution.store');
 Route::patch('/admin/Ticket/{id}/update', [SolutionsController::class, 'update'])->name('admin.Ticket.solution.update');
 Route::delete('/admin/Ticket/{id}/delete', [SolutionsController::class, 'destroy'])->name('admin.Ticket.solution.delete');
 
});

