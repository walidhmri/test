<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\SolutionsController;
use App\Http\Controllers\Admin\TicketsController;
use Illuminate\Support\Facades\Route;





Route::middleware(['auth', 'adminMiddleware'])->group(function () {

 Route::get('/admin/tickets/{user_id}/{id}/solve', [SolutionsController::class, 'index'])->name('admin.tickets.solve');
 Route::get('admin/departments', [DepartmentController::class, 'index'])->name('admin.department.list');
 Route::get('admin/departments/create', [DepartmentController::class, 'create'])->name('admin.department.create');
 Route::get('admin/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('admin.department.edit');
 


 Route::post('admin/departments/store', [DepartmentController::class, 'store'])->name('admin.department.store');
 Route::post('admin/departments/{id}/update', [DepartmentController::class, 'update'])->name('admin.department.update');
 Route::delete('admin/departments/{id}/delete', [DepartmentController::class, 'destroy'])->name('admin.department.delete');



 Route::post('/admin/ticket/{id}/solve', [SolutionsController::class, 'store'])->name('admin.ticket.solution.store');
 Route::patch('/admin/ticket/{id}/update', [SolutionsController::class, 'update'])->name('admin.ticket.solution.update');
 Route::delete('/admin/ticket/{id}/delete', [SolutionsController::class, 'destroy'])->name('admin.ticket.solution.delete');
 
});

