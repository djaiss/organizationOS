<?php

declare(strict_types=1);

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Marketing;
use App\Http\Controllers\Organizations;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;

Route::get('/', [Marketing\MarketingController::class, 'index'])->name('marketing.index');
Route::get('/docs', [Marketing\Docs\MarketingDocController::class, 'index'])->name('marketing.docs.index');
Route::get('/docs/api/authentication', [Marketing\Docs\AuthenticationController::class, 'index'])->name('marketing.docs.api.authentication');

Route::put('/locale', [LocaleController::class, 'update'])->name('locale.update');

Route::middleware(['auth', 'verified', 'set.locale'])->group(function (): void {
    Route::get('organizations', [Organizations\OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('organizations/{organization}', [Organizations\OrganizationController::class, 'show'])->name('organizations.show');
    Route::get('organizations/create', [Organizations\OrganizationController::class, 'create'])->name('organizations.create');
    Route::get('organizations/{organization}', [Organizations\OrganizationController::class, 'show'])->name('organizations.show');
    Route::post('organizations', [Organizations\OrganizationController::class, 'store'])->name('organizations.store');

    Route::redirect('settings', 'settings/profile');

    // settings
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.index');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');

    // logs
    Route::get('settings/profile/logs', [Settings\LogController::class, 'index'])->name('settings.logs.index');

    // emails
    Route::get('settings/profile/emails', [Settings\EmailSentController::class, 'index'])->name('settings.emails.index');

    // security
    Route::get('settings/security', [Settings\Security\SecurityController::class, 'index'])->name('settings.security.index');
    Route::put('settings/password', [Settings\Security\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\Security\AppearanceController::class, 'edit'])->name('settings.appearance.edit');

    // api keys
    Route::get('settings/api-keys/create', [Settings\Security\ApiKeyController::class, 'create'])->name('settings.api-keys.create');
    Route::post('settings/api-keys', [Settings\Security\ApiKeyController::class, 'store'])->name('settings.api-keys.store');
    Route::delete('settings/api-keys/{apiKey}', [Settings\Security\ApiKeyController::class, 'destroy'])->name('settings.api-keys.destroy');
});

require __DIR__ . '/auth.php';
