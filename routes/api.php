<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelpRequestController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->prefix('help-requests')->group(function () {
    Route::post('/', [HelpRequestController::class, 'create']);
    Route::get('/', [HelpRequestController::class, 'index']);
});
