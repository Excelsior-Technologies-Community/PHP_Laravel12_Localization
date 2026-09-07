<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    protected array $supportedLocales = ['en', 'fr', 'de', 'es', 'hi', 'ar', 'gu'];

    public function handle(Request $request, Closure $next): Response
    {
        $localeFromUrl = $request->route('locale');

        if ($localeFromUrl && in_array($localeFromUrl, $this->supportedLocales)) {
            App::setLocale($localeFromUrl);
            Session::put('locale', $localeFromUrl);
            Cookie::queue('locale', $localeFromUrl, 60 * 24 * 30);
        }
        elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        elseif ($request->cookie('locale')) {
            $cookieLocale = $request->cookie('locale');
            if (in_array($cookieLocale, $this->supportedLocales)) {
                App::setLocale($cookieLocale);
                Session::put('locale', $cookieLocale);
            }
        }
        else {
            $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE', 'en'), 0, 2);
            $locale = in_array($browserLang, $this->supportedLocales) ? $browserLang : 'en';
            App::setLocale($locale);
            Session::put('locale', $locale);
            Session::put('browser_detected', true);
        }

        return $next($request);
    }
}
