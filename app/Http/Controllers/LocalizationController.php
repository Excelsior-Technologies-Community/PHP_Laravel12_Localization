<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LocalizationController extends Controller
{
    protected array $supportedLocales = ['en', 'fr', 'de', 'es', 'hi', 'ar', 'gu'];

    public function setLocale(Request $request, string $locale)
    {
        if (!in_array($locale, $this->supportedLocales)) {
            return redirect()->route('home')->with('error', 'Unsupported language!');
        }

        session(['locale' => $locale]);
        Cookie::queue('locale', $locale, 60 * 24 * 30);
        App::setLocale($locale);

        return redirect()->back()->with('success', trans('lang.flash_success'));
    }

    public function home()
    {
        $locale = app()->getLocale();
        $rtlLocales = ['ar'];
        $isRtl = in_array($locale, $rtlLocales);

        Carbon::setLocale($locale);
        $currentDate = Carbon::now()->translatedFormat('l, d F Y');
        $currentTime = Carbon::now()->format('H:i:s');

        $price = 1234567.89;
        $formattedPrice = $this->formatCurrency($price, $locale);

        $itemCounts = [0, 1, 5];

        $dbTranslations = Translation::where('locale', $locale)->orderBy('key')->get();

        return view('home', compact(
            'locale', 'isRtl', 'currentDate', 'currentTime',
            'formattedPrice', 'itemCounts', 'dbTranslations'
        ));
    }

    private function formatCurrency(float $amount, string $locale): string
    {
        $currencies = [
            'en' => ['USD', 'en_US'],
            'fr' => ['EUR', 'fr_FR'],
            'de' => ['EUR', 'de_DE'],
            'es' => ['EUR', 'es_ES'],
            'hi' => ['INR', 'en_IN'],
            'ar' => ['SAR', 'ar_SA'],
            'gu' => ['INR', 'en_IN'],
        ];

        [$currency, $fmtLocale] = $currencies[$locale] ?? ['USD', 'en_US'];

        if (class_exists('NumberFormatter')) {
            $fmt = new \NumberFormatter($fmtLocale, \NumberFormatter::CURRENCY);
            return $fmt->formatCurrency($amount, $currency);
        }

        return number_format($amount, 2) . ' ' . $currency;
    }
}
