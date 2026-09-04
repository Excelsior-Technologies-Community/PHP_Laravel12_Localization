<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    /**
     * Display localization dashboard.
     */
    public function index()
    {
        return view('localization');
    }

    /**
     * Change application language manually.
     */
    public function changeLanguage(Request $request, string $locale)
    {
        $supportedLocales = [
            'en',
            'fr',
            'de',
        ];

        if (!in_array($locale, $supportedLocales, true)) {

            return redirect()
                ->route('localization.index')
                ->with(
                    'error',
                    __('lang.invalid_language')
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Store manually selected language
        |--------------------------------------------------------------------------
        */

        session(['locale' => $locale]);

        /*
        |--------------------------------------------------------------------------
        | Apply immediately
        |--------------------------------------------------------------------------
        */

        app()->setLocale($locale);

        return redirect()
            ->route('localization.index')
            ->with(
                'success',
                __('lang.language_changed')
            );
    }
}