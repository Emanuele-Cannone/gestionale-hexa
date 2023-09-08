@php
    use Carbon\Carbon;
    use App\Models\Roster;
@endphp


@section('script')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {

        let event = @json($res);
        let selector = document.querySelector("#id_selector");
        let currentDayDate = new Date().toISOString().slice(0, 10);

        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            height: 550,
            locale: 'itLocale',
            firstDay: 1,
            buttonText : {
                today:    'oggi',
                month:    'mese',
                week:     'settimana',
                day:      'giorno',
                list:     'lista'
            },
            allDayText: 'Intero giorno',
            headerToolbar: {
                start: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                center: 'title',
                end: 'today prev,next'
            },
            slotMinTime: '06:00:00',
            displayEventEnd: true,
            eventDisplay: 'block',
            nowIndicator: true,
            eventDidMount: function(arg) {
                let val = selector.value;

                if (!(val == arg.event.extendedProps.user_id || val == "all")) {
                    arg.el.style.display = "none";
                }
            },
            events: function (fetchInfo, successCallback, failureCallback) {
                successCallback(event);
            }
            
        });
        calendar.render();
    
        selector.addEventListener('change', function() {
            calendar.refetchEvents();
        });
    });

</script>
@endsection

<x-app-layout>

    <div>

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
                            <a href="{{ route('rosters.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Turni</a>
                        </div>
                    </li>
                </ol>
                <div>
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-300 dark:focus:ring-gray-700">
                        <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm9-10v.4A3.6 3.6 0 0 1 8.4 9H6.61A3.6 3.6 0 0 0 3 12.605M14.458 3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                        </svg>
                        {{ __('common.actions') }}
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a data-modal-target="exportRosterTemplateModal" data-modal-toggle="exportRosterTemplateModal" class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Download Template</a>
                            </li>
                            <li>
                                <a data-modal-target="importRosterModal" data-modal-toggle="importRosterModal" class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Importa Turni</a>
                            </li>
                        </ul>
                    </div>  
                </div>
            </nav>

        </x-slot>

        {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> --}}
            <div class="py-12">
                <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                    
                    <label for="id_selector" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleziona operatore per visualizzare i turni</label>
                    <select id="id_selector" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="all" selected>Tutti</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    
                    <div id="calendar" class="bg-white mt-3 p-2"></div>
                </div> 
            </div> 
        
        
        
    </div>

    <!-- Import Roster Modal -->
    <div id="importRosterModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form action="{{route('importRosterFile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Importa turni
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="importRosterModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">

                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="roster_help" id="roster" type="file" name="rosterFile">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="roster_help">Messaggio di controllo</div>
                
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="importRosterModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Importa</button>
                        <button data-modal-hide="importRosterModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Annulla</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Export Roster Template Modal -->
    <div id="exportRosterTemplateModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form action="{{ route('downloadRosterEmptyExcel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Esporta template turni
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="exportRosterTemplateModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">

                        <select name="weekNumber" required>
                            @foreach ($weeksOfYearAvailable as $weekOfYearAvailable)
                                <option value="{{ $weekOfYearAvailable }}">{{ $weekOfYearAvailable }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="exportRosterTemplateModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Esporta</button>
                        <button data-modal-hide="exportRosterTemplateModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Annulla</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>
