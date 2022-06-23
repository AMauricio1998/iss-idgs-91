<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Datos del area') }}
            </h2>
        </center>
    </x-slot>

    <div class="h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-6 bg-gray-200">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <!-- Name -->
            <div>
                <x-label for="nombre_area" :value="__('Nombre del area')" />

                <x-input id="nombre_area" class="block mt-1 w-full" type="text" name="nombre_area" :value="old('nombre_area', $area->nombre_area)" readonly />

                @error('nombre_area')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="clave" :value="__('Clave del area')" />

                <x-input id="clave" class="block mt-1 w-full" type="text" name="clave"
                    :value="old('clave', $area->clave)" readonly />

                @error('clave')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="descripcion" :value="__('Descripcion corta')" />

                <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion', $area->descripcion)"
                    readonly />

                @error('descripcion')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>

        </div>
        <br>
        <a href="{{ route('area-index') }}" title="Volver"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
            </svg>
        </a>
    </div>

    <br>

</x-app-layout>
