<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Administracion de areas') }}
            </h2>
        </center>
    </x-slot>

    <div class="min-h-screen bg-white py-5">
        
        @include('dashboard.partials.session-flash-status')
        @if(Session::has('msg-store'))
            <div class="bg-green-500 font-bold text-white w-auto text-center" role="alert">
                {{ Session::get('msg-store') }}
            </div>
        @endif

        <div class='overflow-x-auto w-full'>
            <div class="mx-32 py-2" id="proccess">
                <a 
                    href="{{ route('area-create') }}"
                    id="open-btn-pdf"
                    data-modal-toggle="popup-modal-pdf"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                >
                    Nueva area
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

            </div>
            <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                    <tr class="text-white text-left">
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Nombre de area </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Clave </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Descripcion </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Fecha de creacion </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Opciones </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($areas as $area)
                        <tr>
                            <td class="px-6 py-4 text-center">{{ $area->nombre_area }}</td>
                            <td class="px-6 py-4 text-center">{{ $area->clave }}</td>
                            <td class="px-6 py-4 text-center">{{ $area->descripcion }}</td>
                            <td class="px-6 py-4 text-center">{{ $area->created_at->format('d-M-Y') }}</td>
                            <td class="px-6 py-4 text-center flex flex-row justify-center"> 
                                <a 
                                    href="{{ route('area-show', $area->id) }}" 
                                    class="bg-green-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1"
                                    title="Ver"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a 
                                        href="{{ route('area-edit', $area->id) }}" 
                                        class="bg-blue-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1"
                                        title="Editar"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
