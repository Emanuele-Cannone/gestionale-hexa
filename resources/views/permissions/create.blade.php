<x-app-layout>
    <x-slot name="header">
        <!-- Breadcrumb -->
        <nav class="justify-between text-gray-700 sm:flex sm:px-5 bg-gray-50 dark:bg-gray-800" aria-label="Breadcrumb">
            <ol class="inline-flex items-center mb-3 space-x-1 md:space-x-3 sm:mb-0">
                <!-- Home -->
                <li>
                    <div class="flex items-center">
                        <a href="{{route('dashboard')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                        </a>
                    </div>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('manage-people') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('rolePermission.manage-people') }}</a>
                    </div>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('permissions.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('rolePermission.permissions') }}</a>
                    </div>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('permissions.create') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('rolePermission.new_permission') }}</a>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div>
                    <form action="{{route('permissions.store')}}" method="post">
                        @csrf
                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            <x-form-section submit="createCustomer">
                                <x-slot name="title">
                                    {{ __('rolePermission.new_permission') }}
                                </x-slot>
                            
                                <x-slot name="description">
                                    {{ __('rolePermission.permission_description') }}
                                </x-slot>
                            
                                <x-slot name="form">
                            
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="name" value="{{ __('rolePermission.permission_name') }}" />
                                        <x-input id="name" type="text" class="mt-1 block w-full" name="name" value="{{old('name')}}" autofocus />
                                        <x-input-error for="name" class="mt-2" />
                                    </div> 
                            
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="section" value="{{ __('rolePermission.permission_section') }}" />
                                        <x-input id="section" type="text" class="mt-1 block w-full" name="section" value="{{old('section')}}" autofocus />
                                        <x-input-error for="section" class="mt-2" />
                                    </div> 
    
                                </x-slot>
                            
                                <x-slot name="actions">
                                    <x-button>
                                        {{ __('common.create') }}
                                    </x-button>
                                </x-slot>
                            </x-form-section>
    
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
