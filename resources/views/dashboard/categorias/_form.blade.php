
        @csrf

        <!-- Name -->
        <div>
            <x-label for="nombre" :value="__('Nombre del area')" />

            <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $categoria->nombre)" required autofocus />

            @error('nombre')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Registrar') }}
            </x-button>
        </div>
    