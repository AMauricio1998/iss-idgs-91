<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Datos del usuario') }}
            </h2>
        </center>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-6 bg-gray-200">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        

        <!-- Name -->
        <div>
            <x-label for="nombre" :value="__('Nombre')" />

            <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $producto->nombre)" readonly />

            @error('nombre')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="codigo_producto" :value="__('Codigo del producto')" />

            <x-input id="codigo_producto" class="block mt-1 w-full" type="text" name="codigo_producto" :value="old('codigo_producto', $producto->codigo_producto)" readonly />

            @error('codigo_producto')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="descripcion" :value="__('Descripcion corta')" />

            <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion', $producto->descripcion)" readonly />

            @error('descripcion')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="stock" :value="__('Stock')" />

            <x-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', $producto->stock)" readonly />

            @error('stock')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="id_categoria" :value="__('Categoria')" />
            <x-input 
                id="id_categoria" 
                class="block mt-1 w-full" 
                type="text" name="id_categoria" 
                :value="old('id_categoria', $producto->categorias->nombre)" readonly 
            />
        </div>
        
        <div class="mt-4">
            <x-label for="id_unidad" :value="__('Unidad')" />
            <x-input 
                id="id_unidad" 
                class="block mt-1 w-full" 
                type="text" name="id_unidad" 
                :value="old('id_unidad', $producto->unidades->nombre)" readonly 
            />
        </div>
        <div class="mt-4">
            <x-label for="status" :value="__('Status')" />
            <x-input id="status" class="block mt-1 w-full" type="text" name="status" value="{{ $producto->activo == 1 ? 'Activo' : 'Desactivado' }}" readonly />
        </div>

        </div>
        <a 
            href="{{ route('productos-index') }}"
            title="Volver"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"        >  
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
                </svg>
        </a>
    </div>

    <br>

</x-app-layout>