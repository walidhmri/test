<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\SolutionsController;
use App\Http\Controllers\Admin\TicketsController;
use Illuminate\Support\Facades\Route;





Route::middleware(['auth', 'adminMiddleware'])->group(function () {

 Route::get('/admin/tickets/{user_id}/{id}/solve', [SolutionsController::class, 'index'])->name('admin.tickets.solve');
 Route::post('/admin/ticket/{id}/solve', [SolutionsController::class, 'store'])->name('admin.ticket.solution.store');
 Route::patch('/admin/ticket/{id}/update', [SolutionsController::class, 'update'])->name('admin.ticket.solution.update');
 Route::delete('/admin/ticket/{id}/delete', [SolutionsController::class, 'destroy'])->name('admin.ticket.solution.delete');
 
});

