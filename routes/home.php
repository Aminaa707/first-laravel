<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;


// Home

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
});
