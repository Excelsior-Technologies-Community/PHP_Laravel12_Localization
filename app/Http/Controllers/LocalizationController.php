<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index(Request $request, $locale)
    {
        // Set application locale
        app()->setLocale($locale);

        // Display translated message
        echo trans('lang.msg');
    }
}
