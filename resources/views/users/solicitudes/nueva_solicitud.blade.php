<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listado de productos 
            </h2>
        </center>
    </x-slot>

    <div class="min-h-screen bg-white py-5">
        @if(Session::has('add-producto'))
            <div class="bg-green-400 font-bold uppercase text-white text-center" role="alert">
                {{ Session::get('add-producto') }}
            </div>
        @endif
        <div class='overflow-x-auto w-full'>
        <div aria-label="group of cards" tabindex="0" class="focus:outline-none py-8 w-full">
            <div class="lg:flex flex-col items-center justify-center w-full">
                <form action="{{ route('nueva-solicitud') }}">
                    <div class="relative md:block w-auto">
                        <button type="submit" class="flex absolute inset-y-0 left-0 items-center pl-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" class="block p-2 pl-10 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
                    </div>
                </form>
                @forelse ($productos as $producto)
                    <div tabindex="0" aria-label="card 1" class="focus:outline-none lg:w-1/2 mt-3 lg:mr-7 lg:mb-0 mb-7 bg-white dark:bg-gray-800  p-6 shadow rounded">
                        <div class="flex items-center border-b border-gray-200 dark:border-gray-700  pb-6">
                            <img src="https://cdn.tuk.dev/assets/components/misc/doge-coin.png" alt="coin avatar" class="w-12 h-12 rounded-full" />
                            <div class="flex items-start justify-between w-full">
                                <div class="pl-3 w-full">
                                    <p tabindex="0" class="focus:outline-none text-xl font-medium leading-5 text-gray-800 dark:text-white ">{{ $producto->nombre }}</p>
                                    <p tabindex="0" class="focus:outline-none text-sm leading-normal pt-2 text-gray-500 dark:text-gray-200 ">{{ $producto->stock }} {{ $producto->unidades->nombre }}-{{ $producto->unidades->abreviatura }}</p>
                                </div>
                                <div role="img" aria-label="bookmark">
                                    <a href="{{ route('add-producto',['id' => $producto->id]  ) }}">
                                        <i class="fa-solid fa-cart-plus fa-xl"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="px-2">
                            <p tabindex="0" class="focus:outline-none text-sm leading-5 py-4 text-gray-600 dark:text-gray-200 ">{{ $producto->descripcion }}</p>
                            <div tabindex="0" class="focus:outline-none flex">
                                <div class="py-2 px-4 text-xs leading-3 text-indigo-700 rounded-full bg-indigo-100">#{{ $producto->categorias->nombre }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <span class="font-bold bg-red-400 text-center text-white">No hay productos</span>
                @endforelse
                @if (isset($solicitud))
                    @foreach ($solicitud as $soli)
                        <a
                        href="{{ route('mostrar-carrito', $soli->codigo_solicitud) }}"
                            class="bg-blue-500 mt-2 py-1 px-1 font-semibold rounded-lg border-2 border-gray-300 text-white hover:bg-blue-700"
                        >
                            Mostrar Carrito
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        </div>
    </div>
</x-app-layout>