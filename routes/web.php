<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocalizationController;

Route::get('localization/{locale}', [LocalizationController::class, 'index']);
