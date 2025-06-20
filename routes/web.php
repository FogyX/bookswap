<?php

use App\Http\Controllers\BookCardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/cards', [BookCardController::class, 'index'])->name('cards.index');
    Route::get('/cards/create', [BookCardController::class, 'create'])->name('cards.create');
    Route::patch('/cards/soft-delete/{id}', [BookCardController::class, 'softDelete'])->name('cards.soft-delete');
    Route::post('/cards', [BookCardController::class, 'store'])->name('cards.store');

    Route::middleware(['can:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::patch('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
        Route::patch('/admin/reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');
    });
});

require __DIR__ . '/auth.php';
