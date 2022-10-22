<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SubcategoryController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Category
Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

// SubCategory

Route::controller(SubcategoryController::class)->group(function () {
    Route::get('/subcategory/index', 'index')->name('subcategory.index');
    Route::get('/subcategory/create', 'create')->name('subcategory.create');
    Route::post('/subcategory/store', 'store')->name('subcategory.store');
    Route::get('/subcategory/edit/{id}', 'edit')->name('subcategory.edit');
    Route::post('/subcategory/update/{id}', 'update')->name('subcategory.update');
    Route::get('/subcategory/delete/{id}', 'destroy')->name('subcategory.delete');
});

//__ Post __\\

Route::controller(PostController::class)->group(function () {
    Route::get('/post/index', 'index')->name('post.index');
    Route::get('/post/create', 'create')->name('post.create');
    Route::post('/post/store', 'store')->name('post.store');
    Route::get('/post/edit/{id}', 'edit')->name('post.edit');
    Route::post('/post/update/{id}', 'update')->name('post.update');
    Route::get('/post/delete/{id}', 'destroy')->name('post.delete');
});


require __DIR__ . '/auth.php';
