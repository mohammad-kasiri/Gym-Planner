<?php

use App\Http\Controllers\Api\V1\Auth\EntranceController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\OTPController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\EquipmentController;
use App\Http\Controllers\Api\V1\ExerciseController;
use App\Http\Controllers\Api\V1\MuscleController;
use App\Http\Controllers\Api\V1\RoutineController;
use App\Http\Controllers\Api\V1\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"App\Http\Controllers\Api\V1\Auth\\", "prefix" => "v1"], function() {
    Route::post("/enter",        [EntranceController::class, 'index'])    ->name("entrance.index");
    Route::post("/pass-login",   [LoginController::class, 'passLogin'])   ->name("pass-login");
    Route::post("/otp-login",    [LoginController::class, 'OTPLogin'])    ->name("otp-login");

    Route::post("/otp",          [OTPController::class, 'store'])         ->name("otp.store");
    Route::post("/register",     [RegisterController::class, 'register']) ->name("register");
});

Route::group([ 'namespace'=>'App\Http\Controllers\Api\V1\\',
                "prefix" => "v1" ,
                'middleware' => ['auth:sanctum']
             ], function() {
    Route::get("/types",                    [TypeController::class, 'index'])        ->name("type.index");
    Route::get("/equipments",               [EquipmentController::class, 'index'])   ->name("equipment.index");
    Route::get("/muscles",                  [MuscleController::class, 'index'])      ->name("muscle.index");

    Route::get("/exercises",                [ExerciseController::class, 'index'])    ->name("exercise.index");
    Route::post("/exercises",               [ExerciseController::class, 'store'])    ->name("exercise.store");

    Route::get("/routine",                  [RoutineController::class, 'index'])     ->name("routine.index");
    Route::get("/routine/{routine_id}",     [RoutineController::class, 'show'])      ->name("routine.show");
    Route::post("/routine",                 [RoutineController::class, 'store'])     ->name("routine.store");
    Route::delete("/routine/{routine_id}",  [RoutineController::class, 'destroy'])   ->name("routine.destroy");
});
