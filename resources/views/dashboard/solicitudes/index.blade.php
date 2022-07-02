<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Administracion de solicitudes') }}
            </h2>
        </center>
    </x-slot>

    <div class="min-h-screen bg-white py-5">
        
        <div class="min-h-screen bg-white py-5">
        
            @include('dashboard.partials.session-flash-status')
            
            <div class='overflow-x-auto w-full'>
                <div class="mx-32 py-2">
                    <a 
                        href="{{ route('solicitudes-PDF') }}"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                    >
                    <i class="fa-solid fa-xl fa-file-pdf"> </i> Generar PDF 
                    </a>

                    <a 
                        href="{{ route('excel-solicitudes') }}"
                        class="text-white bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-800 dark:hover:bg-green-700 dark:focus:ring-green-700 dark:border-green-700"
                    >
                        Generar excel <i class="fa-solid fa-file-excel"></i>
                    </a>
                </div>
                <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-gray-900">
                        <tr class="text-white text-left">
                            <th class="font-semibold text-sm uppercase px-6 py-4"> Codigo solicitud </th>
                            <th class="font-semibold text-sm uppercase px-2 py-4 text-center"> Num. Productos </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Quien Solicita </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Area </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Status </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Fecha de creación </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> PDF </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Editar </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($solicitudes as $solicitud)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <p> {{ $solicitud->codigo_solicitud }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class=""> {{ $solicitud->num_productos }} </p>
                                </td>
                                <td class="px-6 py-4 text-center"> {{ $solicitud->name }} {{ $solicitud->app }} </td>
                                <td class="px-6 py-4 text-center"> {{ $solicitud->nombre_area }} </td>
                                <td class="px-6 py-4 text-center"> 
                                    @if($solicitud->id_status == 1)
                                        <span class="font-semibold rounded-lg py-1 px-1 text-white bg-blue-400">{{ $solicitud->nombre_status }}</span>
                                    @endif
                                    @if($solicitud->id_status == 2)
                                        <span class="font-semibold rounded-lg py-1 px-1 text-white bg-yellow-600">{{ $solicitud->nombre_status }}</span>
                                    @endif
                                    @if($solicitud->id_status == 3)
                                        <span class="font-semibold rounded-lg py-1 px-1 text-white bg-green-500">{{ $solicitud->nombre_status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center"> {{ $solicitud->created_at->format('d-m-Y') }} </td>
                                <td class="px-6 py-4 text-center"> 
                                    @if ($solicitud->id_status == 3)
                                        <a 
                                            href="{{ route('solicitud-PDF', ['id'=>$solicitud->codigo_solicitud]) }}" 
                                            class="hover:bg-blue-400 bg-blue-500 font-bold py-5 px-3 rounded-lg flex flex-raw mx-1"
                                            title="Ver"
                                        >
                                            <i class="fa-solid fa-xl fa-file-pdf"></i>
                                        </a>
                                    @else
                                        <a 
                                            role="button"
                                            class="hover:bg-red-400 bg-red-500 font-bold py-5 px-3 rounded-lg flex flex-raw mx-1"
                                            title="Ver"
                                            id="open-btn-pdf"
                                            data-modal-toggle="popup-modal-pdf"
                                        >
                                            <i class="fa-solid fa-xl fa-file-pdf"></i>
                                        </a>  

                                        {{--  Modal  --}}
                                        <center>
                                            <div id="popup-modalPdf" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modalPdf">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                                        </button>
                                                        <div class="p-6 text-center">
                                                            <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Solicitud no finalizada</h3>
                                                            <h4 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">PDF no disponible</h4>
                                                            <button id="ok-btn-pdf" data-modal-toggle="popup-modalPdf" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                Ok
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </center>
                                    {{--  Fin modal  --}}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center"> 
                                @if($solicitud->id_status == 1 || $solicitud->id_status == 2)
                                    @if( $solicitud->created_at->format('d') < 20)
                                        <a 
                                            href="{{ route( 'detalle-solicitud', ['id' => $solicitud->codigo_solicitud] ) }}" 
                                            class="bg-green-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1 hover:bg-green-300"
                                            title="Ver"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        </a>
                                    @else
                                    <a 
                                        class="bg-green-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1 hover:bg-green-300"
                                        title="No disponible"
                                        id="open-btn"
                                        data-modal-toggle="popup-modal"
                                        role="button"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{--  Modal  --}}
                                        <center>
                                            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                                        </button>
                                                        <div class="p-6 text-center">
                                                            <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Solicitud fuera del tiempo establecido</h3>
                                                            <button id="ok-btn" data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                Ok
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </center>
                                    {{--  Fin modal  --}}
                                    @endif
                                    @endif
                                    @if($solicitud->id_status == 3)
                                        <a 
                                            href="{{ route( 'detalle-solicitud', ['id' => $solicitud->codigo_solicitud] ) }}" 
                                            class="bg-green-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1 hover:bg-green-300"
                                            title="Ver"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
    
                <center>
                    {{ $solicitudes->links() }}
                </center>
    
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/modal.js') }}"></script>   

</x-app-layout>