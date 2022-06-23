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
                    href="{{ route('categoria-create') }}"
                    id="open-btn-pdf"
                    data-modal-toggle="popup-modal-pdf"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                >
                    Nueva categoria
                </a>
            </div>
            <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                    <tr class="text-white text-left">
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Nombre de area </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Status </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Fecha de creacion </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Opciones </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="px-6 py-4 text-center">{{ $categoria->nombre }}</td>
                            <td class="px-6 py-4 text-center">{{ $categoria->activo }}</td>
                            <td class="px-6 py-4 text-center">{{ $categoria->created_at->format('d-M-Y') }}</td>
                            <td class="px-6 py-4 text-center flex flex-row justify-center"> 
                                <a 
                                    href="{{ route('categoria-show', $categoria->id) }}" 
                                    class="bg-green-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1"
                                    title="Ver"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a 
                                        href="{{ route('categoria-edit', $categoria->id) }}" 
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
