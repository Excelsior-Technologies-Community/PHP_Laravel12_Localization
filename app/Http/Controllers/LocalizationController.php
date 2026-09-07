<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class LocalizationController extends Controller
{
    /**
     * Supported application languages.
     */
    protected array $supportedLocales = [
        'en',
        'fr',
        'de',
        'es',
        'hi',
        'ar',
        'gu',
    ];

    /**
     * Change application language.
     */
    public function setLocale(Request $request, string $locale)
    {
        if (!in_array($locale, $this->supportedLocales, true)) {
            return redirect()
                ->route('localization.index')
                ->with('error', 'Unsupported language!');
        }

        /*
        |--------------------------------------------------------------------------
        | Save language in session
        |--------------------------------------------------------------------------
        */

        session(['locale' => $locale]);

        /*
        |--------------------------------------------------------------------------
        | Save language in cookie for 30 days
        |--------------------------------------------------------------------------
        */

        Cookie::queue(
            'locale',
            $locale,
            60 * 24 * 30
        );

        /*
        |--------------------------------------------------------------------------
        | Apply immediately
        |--------------------------------------------------------------------------
        */

        App::setLocale($locale);

        return redirect()
            ->back()
            ->with(
                'success',
                __('lang.flash_success')
            );
    }

    /**
     * Localization dashboard.
     */
    public function home()
    {
        $locale = app()->getLocale();

        /*
        |--------------------------------------------------------------------------
        | RTL languages
        |--------------------------------------------------------------------------
        */

        $rtlLocales = [
            'ar',
        ];

        $isRtl = in_array($locale, $rtlLocales, true);

        /*
        |--------------------------------------------------------------------------
        | Carbon localization
        |--------------------------------------------------------------------------
        */

        Carbon::setLocale($locale);

        $currentDate = Carbon::now()
            ->translatedFormat('l, d F Y');

        $currentTime = Carbon::now()
            ->format('H:i:s');

        /*
        |--------------------------------------------------------------------------
        | Localized number
        |--------------------------------------------------------------------------
        */

        $number = 1234567.89;

        $formattedNumber = $this->formatNumber(
            $number,
            $locale
        );

        /*
        |--------------------------------------------------------------------------
        | Localized currency
        |--------------------------------------------------------------------------
        */

        $price = 1234567.89;

        $formattedPrice = $this->formatCurrency(
            $price,
            $locale
        );

        /*
        |--------------------------------------------------------------------------
        | Pluralization demo
        |--------------------------------------------------------------------------
        */

        $itemCounts = [
            0,
            1,
            5,
        ];

        /*
        |--------------------------------------------------------------------------
        | Database translations
        |--------------------------------------------------------------------------
        |
        | Cache translations for better performance.
        |
        */

        $dbTranslations = Cache::remember(
            'translations_' . $locale,
            now()->addMinutes(30),
            function () use ($locale) {
                return Translation::where('locale', $locale)
                    ->orderBy('key')
                    ->get();
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Fallback translations
        |--------------------------------------------------------------------------
        |
        | If current language has no DB translations,
        | use English translations.
        |
        */

        if ($dbTranslations->isEmpty() && $locale !== 'en') {
            $dbTranslations = Cache::remember(
                'translations_en',
                now()->addMinutes(30),
                function () {
                    return Translation::where('locale', 'en')
                        ->orderBy('key')
                        ->get();
                }
            );
        }

        return view(
            'home',
            compact(
                'locale',
                'isRtl',
                'currentDate',
                'currentTime',
                'formattedNumber',
                'formattedPrice',
                'itemCounts',
                'dbTranslations'
            )
        );
    }

    /**
     * Localization dashboard page.
     */
    public function index()
    {
        $locale = session(
            'locale',
            request()->cookie('locale', config('app.locale', 'en'))
        );

        if (!in_array($locale, $this->supportedLocales, true)) {
            $locale = 'en';
        }

        App::setLocale($locale);

        return view('localization', [
            'locale' => $locale,
            'supportedLocales' => $this->supportedLocales,
            'isRtl' => $locale === 'ar',
        ]);
    }

    /**
     * Change language from localization dashboard.
     */
    public function changeLanguage(
        Request $request,
        string $locale
    ) {
        if (!in_array($locale, $this->supportedLocales, true)) {
            return redirect()
                ->route('localization.index')
                ->with(
                    'error',
                    __('lang.invalid_language')
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Session
        |--------------------------------------------------------------------------
        */

        session([
            'locale' => $locale,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Cookie - 30 days
        |--------------------------------------------------------------------------
        */

        Cookie::queue(
            'locale',
            $locale,
            60 * 24 * 30
        );

        /*
        |--------------------------------------------------------------------------
        | Apply immediately
        |--------------------------------------------------------------------------
        */

        App::setLocale($locale);

        return redirect()
            ->route('localization.index')
            ->with(
                'success',
                __('lang.language_changed')
            );
    }

    /**
     * Format localized number.
     */
    private function formatNumber(
        float $number,
        string $locale
    ): string {
        if (class_exists('NumberFormatter')) {
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

        return number_format(
            $number,
            2
        );
    }

    /**
     * Format localized currency.
     */
    private function formatCurrency(
        float $amount,
        string $locale
    ): string {
        $currencies = [
            'en' => [
                'USD',
                'en_US',
            ],

            'fr' => [
                'EUR',
                'fr_FR',
            ],

            'de' => [
                'EUR',
                'de_DE',
            ],

            'es' => [
                'EUR',
                'es_ES',
            ],

            'hi' => [
                'INR',
                'en_IN',
            ],

            'ar' => [
                'SAR',
                'ar_SA',
            ],

            'gu' => [
                'INR',
                'en_IN',
            ],
        ];

        [$currency, $fmtLocale] =
            $currencies[$locale]
            ?? ['USD', 'en_US'];

        if (class_exists('NumberFormatter')) {
            $formatter = new \NumberFormatter(
                $fmtLocale,
                \NumberFormatter::CURRENCY
            );

            return $formatter->formatCurrency(
                $amount,
                $currency
            );
        }

        return number_format(
            $amount,
            2
        ) . ' ' . $currency;
    }
}
