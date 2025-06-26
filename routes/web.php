<?php

declare(strict_types=1);

use App\Http\Controllers\Marketing\MarketingController;
use App\Http\Controllers\Organizations\OrganizationController;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;

Route::get('/', [MarketingController::class, 'index'])->name('marketing.index');

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('organizations', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('organizations/{organization}', [OrganizationController::class, 'show'])->name('organizations.show');
    Route::get('organizations', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('organizations/create', [OrganizationController::class, 'create'])->name('organizations.create');
    Route::get('organizations/{organization}', [OrganizationController::class, 'show'])->name('organizations.show');
    Route::post('organizations', [OrganizationController::class, 'store'])->name('organizations.store');

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

require __DIR__ . '/auth.php';
