<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SubcategoryController;

// SubCategory

Route::controller(SubcategoryController::class)->group(function () {
    Route::get('/subcategory/index', 'index')->name('subcategory.index');
    Route::get('/subcategory/create', 'create')->name('subcategory.create');
    Route::post('/subcategory/store', 'store')->name('subcategory.store');
    Route::get('/subcategory/edit/{id}', 'edit')->name('subcategory.edit');
    Route::post('/subcategory/update/{id}', 'update')->name('subcategory.update');
    Route::get('/subcategory/delete/{id}', 'destroy')->name('subcategory.delete');
});
