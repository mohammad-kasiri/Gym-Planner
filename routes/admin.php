<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get ('',                     [HomeController::class ,  'index'])->name('index');

    Route::get('/user',                 [UserController::class ,   'index'])    ->name('user.index');


    Route::get('/type',                 [TypeController::class ,   'index'])    ->name('type.index');
    Route::get('/type/create',          [TypeController::class ,   'create'])   ->name('type.create');
    Route::post('/type',                [TypeController::class ,   'store'])    ->name('type.store');

    //Route::get('/type/{type}/edit',     [TypeController::class ,   'edit'])     ->name('type.edit');
    //Route::patch('/type/{type}',        [TypeController::class ,   'update'])   ->name('type.update');
    //Route::delete('/type/{type}',       [TypeController::class ,   'destroy'])  ->name('type.destroy');

    Route::get ('/index',       [IndexController::class ,  'index'])->name('index.index');
    Route::post('/index',       [IndexController::class ,  'store'])->name('index.store');

});

