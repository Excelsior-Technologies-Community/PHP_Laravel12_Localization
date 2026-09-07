<?php

namespace App\Providers;

use App\Models\Translation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class TranslationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $supportedLocales = Config::get('app.supported_locales', ['en', 'fr', 'de', 'es', 'hi', 'ar', 'gu']);

        foreach ($supportedLocales as $locale) {
            $dbTranslations = Translation::where('locale', $locale)->get()->pluck('value', 'key')->toArray();

            if (!empty($dbTranslations)) {
                $prefixed = [];
                foreach ($dbTranslations as $key => $value) {
                    $prefixed['lang.' . $key] = $value;
                }
                app('translator')->addLines($prefixed, $locale);
            }
        }
    }
}
