<?php

declare(strict_types=1);

use App\Http\Controllers\Administration\AdministrationAccountController;
use App\Http\Controllers\Administration\AdministrationController;
use App\Http\Controllers\Administration\AdministrationOfficeController;
use App\Http\Controllers\Administration\AdministrationSecurityController;
use App\Http\Controllers\Administration\AdministrationUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invitations/{user}/accept', [AdministrationController::class, 'accept'])->name('invitations.accept');

Route::middleware(['auth:sanctum', 'verified'])->group(function (): void {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('administration', [AdministrationController::class, 'index'])->name('administration.index');
    Route::put('administration', [AdministrationController::class, 'update'])->name('administration.update');
    Route::get('administration/security', [AdministrationSecurityController::class, 'index'])->name('administration.security.index');

    Route::middleware(['administrator'])->group(function (): void {
        Route::get('administration/account', [AdministrationAccountController::class, 'index'])->name('administration.account.index');
        Route::put('administration/account', [AdministrationAccountController::class, 'update'])->name('administration.account.update');

        // offices
        Route::get('administration/offices', [AdministrationOfficeController::class, 'index'])->name('administration.offices.index');
    });

    Route::middleware(['administrator_or_hr'])->group(function (): void {
        Route::get('administration/users', [AdministrationUserController::class, 'index'])->name('administration.users.index');

    });
});

require __DIR__.'/auth.php';
