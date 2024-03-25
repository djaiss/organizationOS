<?php

use App\Http\Controllers\Profile\ApiAccessController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // profile management
    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // api access
    Route::get('settings/keys', [ApiAccessController::class, 'index'])->name('settings.api.index');
    Route::get('settings/keys/new', [ApiAccessController::class, 'new'])->name('settings.api.new');
    Route::post('settings/keys', [ApiAccessController::class, 'store'])->name('settings.api.store');
    Route::delete('settings/keys/{id}', [ApiAccessController::class, 'destroy'])->name('settings.api.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/api.php';
