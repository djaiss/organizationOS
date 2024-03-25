<?php

use App\Http\Controllers\Api\MeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('api')->group(function () {
    Route::get('me', [MeController::class, 'show'])->name('me');
});
