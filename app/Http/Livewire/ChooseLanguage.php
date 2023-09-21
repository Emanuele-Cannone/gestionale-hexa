<?php

namespace App\Http\Livewire;

use App\Models\Language;
use Livewire\Component;

class ChooseLanguage extends Component
{
    public function render()
    {
        $languages = Language::all();

        return view('profile.choose-language', ['languages' => $languages]);
    }

    public function changeLocale($language)
    {
        session(['locale' => $language]);

        return redirect()->to('/user/profile');
    }
}
