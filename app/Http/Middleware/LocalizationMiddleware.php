<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Supported application locales.
     */
    protected array $supportedLocales = [
        'en',
        'fr',
        'de',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Check session locale
        |--------------------------------------------------------------------------
        |
        | If the user has already selected a language, always use it.
        |
        */

        $locale = session('locale');

        /*
        |--------------------------------------------------------------------------
        | 2. Detect browser language for first-time visitors
        |--------------------------------------------------------------------------
        |
        | If there is no locale stored in the session, inspect the browser's
        | Accept-Language header.
        |
        */

        if (!$locale) {
            $locale = $this->detectBrowserLocale($request);

            // Save detected language for future requests.
            session(['locale' => $locale]);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Validate locale
        |--------------------------------------------------------------------------
        */

        if (!in_array($locale, $this->supportedLocales, true)) {
            $locale = config('app.fallback_locale', 'en');

            session(['locale' => $locale]);
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Apply locale
        |--------------------------------------------------------------------------
        */

        app()->setLocale($locale);

        return $next($request);
    }

    /**
     * Detect the user's preferred browser language.
     */
    protected function detectBrowserLocale(Request $request): string
    {
        $fallbackLocale = config('app.fallback_locale', 'en');

        $acceptLanguage = $request->header('Accept-Language');

        if (!$acceptLanguage) {
            return $fallbackLocale;
        }

        /*
        |--------------------------------------------------------------------------
        | Parse Accept-Language header
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | en-US,en;q=0.9,fr;q=0.8
        |
        */

        $languages = explode(',', $acceptLanguage);

        foreach ($languages as $language) {

            // Remove quality value such as ;q=0.9
            $language = explode(';', $language)[0];

            // Remove spaces
            $language = trim($language);

            // Get primary language code.
            // en-US → en
            // fr-FR → fr
            // de-DE → de
            $languageCode = strtolower(
                explode('-', $language)[0]
            );

            if (in_array($languageCode, $this->supportedLocales, true)) {
                return $languageCode;
            }
        }

        return $fallbackLocale;
    }
}