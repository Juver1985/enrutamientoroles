<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

// Solo admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Solo cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');
});

require __DIR__.'/auth.php';
