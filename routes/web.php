<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;

Route::get('/', [LocalizationController::class, 'index'])
    ->name('localization.index');

Route::get('/localization', [LocalizationController::class, 'index'])
    ->name('localization.index');

Route::get('/localization/{locale}', [LocalizationController::class, 'changeLanguage'])
    ->name('localization.change');