<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="">
        <x-section-title>
            <x-slot name="title">{{ __('profile.language') }}</x-slot>
            <x-slot name="description">{{ __('profile.select_language') }}</x-slot>
        </x-section-title>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2 px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow rounded-md">
        <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{{ __('profile.available_languages') }}</h3>
        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @foreach ($languages as $lang)
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center pl-3">
                        <input id="horizontal-list-radio-language-{{$lang->locale}}" type="radio" 
                        wire:click="changeLocale('{{ $lang->locale }}')" value="{{ $lang->locale }}" name="list-radio" 
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" 
                        {{ app()->getLocale() == $lang->locale ? 'checked' : ''}}
                        >
                        <label for="horizontal-list-radio-language-{{$lang->locale}}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $lang->locale }}</label>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
    
</div>