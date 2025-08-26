<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// login
Route::post('/login', [LoginController::class, 'store']);

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function (): void {
    // logout
    Route::delete('/logout', [LoginController::class, 'destroy']);
});
