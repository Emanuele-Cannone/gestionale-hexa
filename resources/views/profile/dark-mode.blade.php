<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="">
        <x-section-title>
            <x-slot name="title">{{ __('profile.theme') }}</x-slot>
            <x-slot name="description">{{ __('profile.select_theme') }}</x-slot>
        </x-section-title>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2 px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow rounded-md">

        <x-dark-mode-toggle />

    </div>
    
</div>