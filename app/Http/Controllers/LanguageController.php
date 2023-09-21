<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function changeLocale(Language $language): RedirectResponse
    {
        session()->push('locale', $language->locale);

        return back();

    }
}
