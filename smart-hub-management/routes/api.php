<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BorrowingController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('equipment', EquipmentController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('borrowings', BorrowingController::class);
});