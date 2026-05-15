<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\EquipmentController;
use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\BorrowingController;

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

    Route::get('/web/rooms', [RoomController::class, 'index']);
    Route::get('/web/rooms/create', [RoomController::class, 'create']);
    Route::post('/web/rooms', [RoomController::class, 'store']);
    Route::get('/web/rooms/{id}/edit', [RoomController::class, 'edit']);
    Route::put('/web/rooms/{id}', [RoomController::class, 'update']);
    Route::delete('/web/rooms/{id}', [RoomController::class, 'destroy']);

    Route::get('/web/borrowings', [BorrowingController::class, 'index']);
    Route::get('/web/borrowings/create', [BorrowingController::class, 'create']);
    Route::post('/web/borrowings', [BorrowingController::class, 'store']);
    Route::get('/web/borrowings/{id}/edit', [BorrowingController::class, 'edit']);
    Route::put('/web/borrowings/{id}', [BorrowingController::class, 'update']);
    Route::delete('/web/borrowings/{id}', [BorrowingController::class, 'destroy']);
});