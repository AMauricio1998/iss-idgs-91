
        @csrf

        <!-- Name -->
        <div>
            <x-label for="nombre_areas" :value="__('Nombre del area')" />

            <x-input id="nombre_area" class="block mt-1 w-full" type="text" name="nombre_area" :value="old('nombre_area', $area->nombre_area)" required autofocus />

            @error('nombre_area')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="clave" :value="__('Clave del area')" />

            <x-input id="clave" class="block mt-1 w-full" type="text" name="clave" :value="old('clave', $area->clave)" required autofocus />

            @error('clave')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="descripcion" :value="__('Descripcion corta')" />

            <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion', $area->descripcion)" required autofocus />

            @error('descripcion')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Registrar') }}
            </x-button>
        </div>
    