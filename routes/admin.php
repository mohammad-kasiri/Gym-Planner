<?php

use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\MuscleController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get ('',                     [HomeController::class ,  'index'])->name('index');

    Route::get('/user',                 [UserController::class ,   'index'])    ->name('user.index');


    Route::get('/type',                 [TypeController::class ,   'index'])    ->name('type.index');
    Route::get('/type/create',          [TypeController::class ,   'create'])   ->name('type.create');
    Route::post('/type',                [TypeController::class ,   'store'])    ->name('type.store');

    Route::get('/muscle',               [MuscleController::class , 'index'])    ->name('muscle.index');
    Route::post('/muscle',              [MuscleController::class , 'store'])    ->name('muscle.store');

    Route::get('/equipment',            [EquipmentController::class , 'index']) ->name('equipment.index');
    Route::post('/equipment',           [EquipmentController::class , 'store']) ->name('equipment.store');

    Route::get ('/index',       [IndexController::class ,  'index'])->name('index.index');
    Route::post('/index',       [IndexController::class ,  'store'])->name('index.store');

});

