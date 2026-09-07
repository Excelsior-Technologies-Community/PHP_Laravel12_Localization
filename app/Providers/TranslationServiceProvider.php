<?php

namespace App\Providers;

use App\Models\Translation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Do not query the database if the translations table
        // does not exist yet.
        try {
            if (!Schema::hasTable('translations')) {
                return;
            }
        } catch (\Throwable $e) {
            return;
        }

        $supportedLocales = Config::get(
            'app.supported_locales',
            ['en', 'fr', 'de', 'es', 'hi', 'ar', 'gu']
        );

        foreach ($supportedLocales as $locale) {

            $dbTranslations = Translation::where('locale', $locale)
                ->get()
                ->pluck('value', 'key')
                ->toArray();

            if (!empty($dbTranslations)) {

                $prefixed = [];

                foreach ($dbTranslations as $key => $value) {
                    $prefixed['lang.' . $key] = $value;
                }

                app('translator')->addLines(
                    $prefixed,
                    $locale
                );
            }
        }
    }
}