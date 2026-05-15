<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\EquipmentController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/web/equipment', [EquipmentController::class, 'index']);
    Route::get('/web/equipment/create', [EquipmentController::class, 'create']);
    Route::post('/web/equipment', [EquipmentController::class, 'store']);
    Route::get('/web/equipment/{id}/edit', [EquipmentController::class, 'edit']);
    Route::put('/web/equipment/{id}', [EquipmentController::class, 'update']);
    Route::delete('/web/equipment/{id}', [EquipmentController::class, 'destroy']);
});