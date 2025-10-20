<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SupplierController;  
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


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

Route::get('admin/suppliers/create', [SupplierController::class, 'create'])->name('admin.suppliers.create');
Route::post('admin/suppliers', [SupplierController::class, 'store'])->name('admin.suppliers.store');
Route::get('admin/suppliers/index', [SupplierController::class, 'index'])->name('admin.suppliers.index');
Route::put('admin/suppliers/update/{id}', [SupplierController::class, 'update'])->name('admin.suppliers.update');
Route::delete('admin/suppliers/destroy/{supplier}', [SupplierController::class, 'destroy'])->name('admin.suppliers.destroy');




Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');





Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
Route::post('admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
Route::get('admin/category/index', [CategoryController::class, 'index'])->name('admin.category.index');
Route::put('admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
Route::delete('admin/category/destroy/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');