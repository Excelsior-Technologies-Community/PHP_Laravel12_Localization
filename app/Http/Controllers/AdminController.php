<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /**
     * Translation administration dashboard.
     */
    public function index(Request $request)
    {
        $query = Translation::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('key', 'like', "%{$search}%")
                    ->orWhere('value', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Locale filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('locale')) {
            $query->where(
                'locale',
                $request->locale
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $translations = $query
            ->orderBy('locale')
            ->orderBy('key')
            ->paginate(10)
            ->withQueryString();

        $locales = [
            'en',
            'fr',
            'de',
            'es',
            'hi',
            'ar',
            'gu',
        ];

        return view(
            'admin',
            compact(
                'translations',
                'locales'
            )
        );
    }

    /**
     * Store translation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'locale' => [
                'required',
                'string',
                'max:10',
                'in:en,fr,de,es,hi,ar,gu',
            ],

            'key' => [
                'required',
                'string',
                'max:255',
            ],

            'value' => [
                'required',
                'string',
            ],
        ]);

        Translation::updateOrCreate(
            [
                'locale' => $validated['locale'],
                'key' => $validated['key'],
            ],
            [
                'value' => $validated['value'],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Clear translation cache
        |--------------------------------------------------------------------------
        */

        Cache::forget(
            'translations_' . $validated['locale']
        );

        return redirect()
            ->route('admin.index')
            ->with(
                'success',
                trans('lang.translation_saved')
            );
    }

    /**
     * Update translation.
     */
    public function update(
        Request $request,
        Translation $translation
    ) {
        $request->validate([
            'value' => [
                'required',
                'string',
            ],
        ]);

        $locale = $translation->locale;

        $translation->update([
            'value' => $request->value,
        ]);

        Cache::forget(
            'translations_' . $locale
        );

        return redirect()
            ->route('admin.index')
            ->with(
                'success',
                trans('lang.translation_updated')
            );
    }

    /**
     * Delete translation.
     */
    public function destroy(
        Translation $translation
    ) {
        $locale = $translation->locale;

        $translation->delete();

        Cache::forget(
            'translations_' . $locale
        );

        return redirect()
            ->route('admin.index')
            ->with(
                'success',
                trans('lang.translation_deleted')
            );
    }

    /**
     * Export translations as CSV.
     */
    public function export(Request $request): StreamedResponse
    {
        $query = Translation::query();

        if ($request->filled('locale')) {
            $query->where(
                'locale',
                $request->locale
            );
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where(
                    'key',
                    'like',
                    "%{$search}%"
                )->orWhere(
                    'value',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $translations = $query
            ->orderBy('locale')
            ->orderBy('key')
            ->get();

        return response()->streamDownload(
            function () use ($translations) {

                $handle = fopen(
                    'php://output',
                    'w'
                );

                /*
                |--------------------------------------------------------------------------
                | CSV header
                |--------------------------------------------------------------------------
                */

                fputcsv(
                    $handle,
                    [
                        'ID',
                        'Locale',
                        'Key',
                        'Value',
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | CSV rows
                |--------------------------------------------------------------------------
                */

                foreach ($translations as $translation) {
                    fputcsv(
                        $handle,
                        [
                            $translation->id,
                            $translation->locale,
                            $translation->key,
                            $translation->value,
                        ]
                    );
                }

                fclose($handle);
            },
            'translations.csv',
            [
                'Content-Type' =>
                'text/csv; charset=UTF-8',
            ]
        );
    }

    /**
     * Clear localization cache.
     */
    public function clearCache()
    {
    
        foreach (
            [
                'en',
                'fr',
                'de',
                'es',
                'hi',
                'ar',
                'gu',
            ] as $locale
        ) {
            Cache::forget(
                'translations_' . $locale
            );
        }

        return redirect()
            ->route('admin.index')
            ->with(
                'success',
                'Translation cache cleared successfully.'
            );
    }
}
