<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;


//__ Post __\\

Route::controller(PostController::class)->group(function () {
    Route::get('/post/index', 'index')->name('post.index');
    Route::get('/post/create', 'create')->name('post.create');
    Route::post('/post/store', 'store')->name('post.store');
    Route::get('/post/edit/{id}', 'edit')->name('post.edit');
    Route::post('/post/update/{id}', 'update')->name('post.update');
    Route::get('/post/delete/{id}', 'destroy')->name('post.delete');
});
