<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelpRequestController;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('/', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/help-requests', [HelpRequestController::class, 'store']);
    Route::get('/help-requests', [HelpRequestController::class, 'index']);
    Route::get('/help-requests/{id}', [HelpRequestController::class, 'show']);
    Route::put('/help-requests/{id}', [HelpRequestController::class, 'update']);
    Route::delete('/help-requests/{id}', [HelpRequestController::class, 'destroy']);
});
