<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\Settings\Security;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function (): void {
    Route::get('health', [HealthController::class, 'show'])->middleware('throttle:60,1');

    // login
    Route::post('/login', [LoginController::class, 'store']);

    Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function (): void {
        // logout
        Route::delete('/logout', [LoginController::class, 'destroy']);

        // api keys
        Route::get('settings/api', [Security\ApiKeyController::class, 'index'])->name('settings.api');
        Route::get('settings/api/{id}', [Security\ApiKeyController::class, 'show'])->name('settings.api.show');
        Route::post('settings/api', [Security\ApiKeyController::class, 'create'])->name('settings.api.create');
        Route::delete('settings/api/{id}', [Security\ApiKeyController::class, 'destroy'])->name('settings.api.destroy');
    });
});
