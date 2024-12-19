<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpaceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('user', UserController::class);

// Rutas adicionales para manejar usuarios
Route::put('user/email/{email}', [UserController::class, 'update']);
Route::put('user/id/{id}', [UserController::class, 'update']);
Route::delete('user/email/{email}', [UserController::class, 'destroy']);
Route::get('user/email/{email}', [UserController::class, 'show']);

Route::apiResource('space', SpaceController::class);

// Ruta adicional para manejar spaces
Route::get('spaces/island/{islandIdentifier}', [SpaceController::class, 'indexIsla']);
Route::post('/spaces/{regNumber}/comment', [SpaceController::class, 'storeByRegNumber']);