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
            </ol>

        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                        Gestione Ruoli e Permessi
                    </h1>

                    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                        In questa sezione potrai gestire, creare ed eliminare Ruoli e Permessi
                    </p>
                </div>

                <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">

                    <!-- Ruoli -->
                    <div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 stroke-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10v5m0 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 0v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V5m0 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                              </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                Ruoli
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            In questa sezione potrai gestire i ruoli presenti nel gestionale, aggiugnere un nuovo ruolo ed assegnare permessi.
                        </p>

                        <p class="mt-4 text-sm">
                            <a href="{{ route('roles.index') }}" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                                Gestisci i Ruoli

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </p>
                    </div>

                    <!-- Utenti Ruoli -->
                    <div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 stroke-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.333 6.764a3 3 0 1 1 3.141-5.023M2.5 16H1v-2a4 4 0 0 1 4-4m7.379-8.121a3 3 0 1 1 2.976 5M15 10a4 4 0 0 1 4 4v2h-1.761M13 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
                              </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                Ruolo Utenti
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            In questa sezione potrai associare un ruolo ed ulteriori permessi ad una specifica utenza.
                        </p>

                        <p class="mt-4 text-sm">
                            <a href="{{ route('user-role') }}" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                                Associa Ruoli

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </p>
                    </div>

                    <!-- Utenti Permessi -->
                    <div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 stroke-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 10a28.076 28.076 0 0 1-1.091 9M6.231 2.37a8.994 8.994 0 0 1 12.88 3.73M1.958 13S2 12.577 2 10a8.949 8.949 0 0 1 1.735-5.307m12.84 3.088c.281.706.426 1.46.425 2.22a30 30 0 0 1-.464 6.231M5 10a6 6 0 0 1 9.352-4.974M3 19a5.964 5.964 0 0 1 1.01-3.328 5.15 5.15 0 0 0 .786-1.926m8.66 2.486a13.96 13.96 0 0 1-.962 2.683M6.5 17.336C8 15.092 8 12.846 8 10a3 3 0 1 1 6 0c0 .75 0 1.521-.031 2.311M11 10.001c0 3 0 6-2 9"/>
                              </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                <a href="{{ route('user-role') }}">Permessi Utenti</a>
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            In questa sezione potrai monitorare il numero di utenze per ogni ruolo.
                        </p>

                        <p class="mt-4 text-sm">
                            <a href="{{ route('role-monitor') }}" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                                Monitora utenti

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
