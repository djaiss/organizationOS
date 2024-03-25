<?php

use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\Organization\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [MeController::class, 'show'])->name('me');

    // manage organizations
    Route::post('organizations', [OrganizationController::class, 'store'])->name('organizations.store');
});
