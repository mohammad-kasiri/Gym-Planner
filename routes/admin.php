<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get ('',       [HomeController::class ,  'index'])->name('index');

});

