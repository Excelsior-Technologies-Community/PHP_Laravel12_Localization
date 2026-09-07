<?php

if (!function_exists('formatLocalizedDate')) {

    function formatLocalizedDate(\Carbon\Carbon $date): string
    {
        $locale = app()->getLocale();

        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::LONG,
            \IntlDateFormatter::NONE
        );

        return $formatter->format($date);
    }
}

if (!function_exists('formatLocalizedNumber')) {

    function formatLocalizedNumber(float $number): string
    {
        $locale = app()->getLocale();

        $formatter = new \NumberFormatter(
            $locale,
            \NumberFormatter::DECIMAL
        );

        $formatter->setAttribute(
            \NumberFormatter::FRACTION_DIGITS,
            2
        );

        return $formatter->format($number);
    }
}