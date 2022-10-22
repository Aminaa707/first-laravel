<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;


// Category
Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
