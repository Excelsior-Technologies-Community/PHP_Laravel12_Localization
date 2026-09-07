<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $translations = Translation::orderBy('locale')->orderBy('key')->get();
        return view('admin', compact('translations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'locale' => 'required|string|max:10',
            'key'    => 'required|string|max:255',
            'value'  => 'required|string',
        ]);

        Translation::updateOrCreate(
            ['locale' => $request->locale, 'key' => $request->key],
            ['value' => $request->value]
        );

        return redirect()->route('admin.index')->with('success', trans('lang.translation_saved'));
    }

    public function update(Request $request, Translation $translation)
    {
        $request->validate([
            'value' => 'required|string',
        ]);

        $translation->update(['value' => $request->value]);

        return redirect()->route('admin.index')->with('success', trans('lang.translation_updated'));
    }

    public function destroy(Translation $translation)
    {
        $translation->delete();
        return redirect()->route('admin.index')->with('success', trans('lang.translation_deleted'));
    }
}
