<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Administracion de los producto') }} 
            </h2>
        </center>
    </x-slot>

    <div class="min-h-screen bg-white py-5">
        @include('dashboard.partials.session-flash-status')
        <div class='overflow-x-auto w-full'>
            
            <div class="mx-32 py-2" id="proccess">
                <a 
                    href="{{ route('productos-create') }}"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                >
                    Nuevo producto
                </a>
            </div>
            
                <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-gray-900">
                        <tr class="text-white text-left">
                            <th class="font-semibold text-sm uppercase px-6 py-4"> Nombre </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Codigo </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Stock </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Status </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Categoria </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Unidad </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Fecha de alta </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Opciones </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($productos as $producto)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <p> {{ $producto->nombre }}</p>
                                            <p class="text-gray-500 text-sm font-semibold tracking-wide"> {{ $producto->descripcion }} </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class=""> {{ $producto->codigo_producto }} </p>
                                </td>
                                <td class="px-6 py-4 text-center"> {{ $producto->stock }} {{ $producto->unidades->abreviatura }} </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="text-white text-sm w-1/3 pb-1 bg-{{ $producto->activo == '1' ? 'green-600' : 'red-700' }} font-semibold px-2 rounded-full"
                                    >
                                        {{ $producto->activo == '1' ? 'Disponible' : 'Agotado' }} 
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center"> {{ $producto->categorias->nombre }} </td>
                                <td class="px-6 py-4 text-center"> 
                                    {{ $producto->unidades->nombre }}
                                </td>
                                <td class="px-6 py-4 text-center"> {{ $producto->created_at->format('d-m-Y') }} </td>
                                <td class="px-6 py-4 text-center flex flex-row"> 
                                    <a 
                                        href="{{ route('productos-show', $producto->id) }}" 
                                        class="bg-green-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1"
                                        title="Ver"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a 
                                        href="{{ route('productos-edit', $producto->id) }}" 
                                        class="bg-blue-500 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1"
                                        title="Editar"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    
                                    <a 
                                        href="{{ route('productos-showImage', $producto->id) }}" 
                                        class="bg-red-300 font-bold py-2 px-2 rounded-lg flex flex-raw mx-1"
                                        title="Imagenes"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                      </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <p class="text-red-700 font-bold text-center bg-red-300 rounded-lg my-4">No hay productos registrados</p>
                        @endforelse
                    </tbody>
                </table>
    </div>
</x-app-layout>