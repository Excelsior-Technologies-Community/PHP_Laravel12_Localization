<?php

use Carbon\Carbon;

if (!function_exists('formatLocalizedDate')) {

    function formatLocalizedDate(Carbon $date): string
    {
        $locale = app()->getLocale();

        if (class_exists('IntlDateFormatter')) {

            $formatter = new \IntlDateFormatter(
                $locale,
                \IntlDateFormatter::LONG,
                \IntlDateFormatter::NONE
            );

            return $formatter->format($date);
        }

        return $date->translatedFormat(
            'd F Y'
        );
    }
}

if (!function_exists('formatLocalizedNumber')) {

    function formatLocalizedNumber(
        float $number
    ): string {

        $locale = app()->getLocale();

        if (class_exists('NumberFormatter')) {

            $formatter = new \NumberFormatter(
                $locale,
                \NumberFormatter::DECIMAL
            );

            $formatter->setAttribute(
                \NumberFormatter::FRACTION_DIGITS,
                2
            );

            return $formatter->format(
                $number
            );
        }

        return number_format(
            $number,
            2
        );
    }
}

if (!function_exists('getSupportedLocales')) {

    function getSupportedLocales(): array
    {
        return [
            'en',
            'fr',
            'de',
            'es',
            'hi',
            'ar',
            'gu',

        ];
    }
}

if (!function_exists('isRtlLocale')) {

    function isRtlLocale(
        ?string $locale = null
    ): bool {

        $locale = $locale
            ?? app()->getLocale();

        return in_array(
            $locale,
            ['ar'],
            true
        );
    }
}

