<?php

use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\Organization\OrganizationController;
use App\Http\Controllers\Api\Organization\PermissionController;
use App\Http\Middleware\CheckOrganization;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [MeController::class, 'show'])->name('me');

    // manage organizations
    Route::post('organizations', [OrganizationController::class, 'store']);

    Route::middleware(CheckOrganization::class)->group(function () {
        Route::post('organizations/{organization}/permissions', [PermissionController::class, 'store']);
    });
});
