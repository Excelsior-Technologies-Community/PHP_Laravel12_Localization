<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Localization Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [LocalizationController::class, 'index']
)->name('localization.index');

Route::get(
    '/localization',
    [LocalizationController::class, 'index']
)->name('localization.index');

/*
|--------------------------------------------------------------------------
| Change Language
|--------------------------------------------------------------------------
*/

Route::get(
    '/localization/{locale}',
    [LocalizationController::class, 'changeLanguage']
)->name('localization.change');

/*
|--------------------------------------------------------------------------
| Home / Full Localization Demo
|--------------------------------------------------------------------------
*/

Route::get(
    '/home',
    [LocalizationController::class, 'home']
)->name('localization.home');

/*
|--------------------------------------------------------------------------
| Admin Translation Management
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/translations',
    [AdminController::class, 'index']
)->name('admin.index');

/*
|--------------------------------------------------------------------------
| Create / Save Translation
|--------------------------------------------------------------------------
*/

Route::post(
    '/admin/translations',
    [AdminController::class, 'store']
)->name('admin.store');

/*
|--------------------------------------------------------------------------
| Update Translation
|--------------------------------------------------------------------------
*/

Route::put(
    '/admin/translations/{translation}',
    [AdminController::class, 'update']
)->name('admin.update');

/*
|--------------------------------------------------------------------------
| Delete Translation
|--------------------------------------------------------------------------
*/

Route::delete(
    '/admin/translations/{translation}',
    [AdminController::class, 'destroy']
)->name('admin.destroy');

/*
|--------------------------------------------------------------------------
| Export CSV
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/translations/export',
    [AdminController::class, 'export']
)->name('admin.export');

/*
|--------------------------------------------------------------------------
| Clear Translation Cache
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/translations/cache/clear',
    [AdminController::class, 'clearCache']
)->name('admin.cache.clear');
