<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\HealthController;
use Illuminate\Support\Facades\Route;

Route::get('health', [HealthController::class, 'show'])->middleware('throttle:60,1');

// login
Route::post('/login', [LoginController::class, 'store']);

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function (): void {
    // logout
    Route::delete('/logout', [LoginController::class, 'destroy']);
});
