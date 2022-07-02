<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Administracion de usuarios') }}
            </h2>
        </center>
    </x-slot>

    <div class="min-h-screen bg-white py-5">
        
        @include('dashboard.partials.session-flash-status')

        <div class='overflow-x-auto w-full'>
            <div class="mx-32 py-2" id="proccess">
                <a 
                    href="{{ route('usuario-create') }}"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                >
                    Nuevo usuario
                </a>
                
                <a 
                    href="{{ route('excel-usuarios') }}"
                    class="text-white bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-800 dark:hover:bg-green-700 dark:focus:ring-green-700 dark:border-green-700"
                >
                    Generar excel <i class="fa-solid fa-file-excel"></i>
                </a>
            </div>
            <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                    <tr class="text-white text-left">
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Name </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Telefono </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Area </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> rol </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Fecha de alta </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> status </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Opciones </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($usuarios as $usu)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <p> {{ $usu->name }} {{ $usu->app }} </p>
                                        <p class="text-gray-500 text-sm font-semibold tracking-wide"> {{ $usu->email }} </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class=""> {{ $usu->telefono }} </p>
                            </td>
                            <td class="px-6 py-4 text-center"> {{ $usu->areas->nombre_area }} </td>
                            <td class="px-6 py-4 text-center"> {{ $usu->roles->nombre_rol }} </td>
                            <td class="px-6 py-4 text-center"> {{ $usu->created_at->format('d-m-Y') }} </td>
                            <td class="px-6 py-4 text-center"> 
                                <span 
                                    class="text-white text-sm w-1/3 pb-1 bg-{{ $usu->status == '1' ? 'green-600' : 'red-700' }} font-semibold px-2 rounded-full"
                                > 
                                    {{ $usu->status == '1' ? 'Activo' : 'Inactivo' }}
                                </span> 
                            </td>
                            <td class="px-6 py-4 text-center flex flex-row"> 
                                <a 
                                    href="{{ route('usuario-show', $usu->id) }}" 
                                    class="bg-green-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1"
                                    title="Ver"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a 
                                href="{{ route('usuario-edit', $usu->id) }}" 
                                class="bg-blue-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1"
                                    title="Editar"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('usuario-proccess', $usu->id) }}"
                                    class="bg-indigo-200 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1 approved"
                                    title="{{ $usu->status == '1' ? 'Desactivar' : 'Activar' }}"
                                >
                                @csrf
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </button>
                                </form>

                                @if (auth()->user()->id == $usu->id)

                                @else
                                    <form action="{{ route('usuario-destroy', $usu->id) }}" 
                                        class="bg-red-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1 hover:bg-red-400"
                                        method="POST" name="borrar">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                              </svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>

            <center>
                {{ $usuarios->links() }}
            </center>

        </div>
    </div>

    
</x-app-layout>