<?php

use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\Organization\OrganizationController;
use App\Http\Controllers\Api\Organization\PermissionController;
use App\Http\Middleware\CheckOrganization;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [MeController::class, 'show'])->name('me');

    // manage organizations
    Route::get('organizations', [OrganizationController::class, 'index']);
    Route::post('organizations', [OrganizationController::class, 'create']);

    Route::middleware(CheckOrganization::class)->prefix('organizations/{organization}')->group(function () {
        // permissions
        Route::post('/permissions', [PermissionController::class, 'create']);
        Route::put('/permissions/{permission}', [PermissionController::class, 'update']);
        Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy']);
    });
});
