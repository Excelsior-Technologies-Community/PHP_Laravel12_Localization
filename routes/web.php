<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\AdminController;

// Home page
Route::get('/', [LocalizationController::class, 'home'])->name('home');

// Language switcher
Route::get('locale/{locale}', [LocalizationController::class, 'setLocale'])->name('locale.set');

// URL prefix locale routes - middleware auto-detects locale from URL
Route::prefix('{locale}')->where(['locale' => 'en|fr|de|es|hi|ar|gu'])->group(function () {
    Route::get('home', [LocalizationController::class, 'home'])->name('locale.home');
});

// Admin panel routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                              [AdminController::class, 'index'])->name('index');
    Route::post('/translations',                 [AdminController::class, 'store'])->name('store');
    Route::put('/translations/{translation}',    [AdminController::class, 'update'])->name('update');
    Route::delete('/translations/{translation}', [AdminController::class, 'destroy'])->name('destroy');
});

// Old route (backward compatible)
Route::get('localization/{locale}', [LocalizationController::class, 'setLocale']);
