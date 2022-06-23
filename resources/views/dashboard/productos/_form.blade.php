
        @csrf

        <!-- Name -->
        <div>
            <x-label for="nombre" :value="__('Nombre')" />

            <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $producto->nombre)" required autofocus />

            @error('nombre')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="codigo_producto" :value="__('Codigo del producto')" />

            <x-input id="codigo_producto" class="block mt-1 w-full" type="text" name="codigo_producto" :value="old('codigo_producto', $producto->codigo_producto)" required autofocus />

            @error('codigo_producto')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="descripcion" :value="__('Descripcion corta')" />

            <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion', $producto->descripcion)" required autofocus />

            @error('descripcion')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        {{--  <div class="mt-4">
            <x-label for="imagen" :value="__('Imagen')" />

            <x-input id="imagen" class="block mt-1 w-full" type="file" name="imagen" :value="old('imagen', $producto->imagen)" required autofocus />

            @error('imagen')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>  --}}

        <div class="mt-4">
            <x-label for="stock" :value="__('Stock')" />

            <x-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', $producto->stock)" required autofocus />

            @error('stock')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="id_categoria" :value="__('Categoria')" />
            <div class="alerta mb-3 xl:w-full">
                <select 
                    name="id_categoria" 
                    id="id_categoria" 
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                >
                    <option value="">-- Selecciona una categoria --</option>
                    @foreach ($categorias as $id => $nombre)
                        <option {{ $producto->id_categoria == $id ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>

                @error('id_categoria')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>
        </div>
        
        <div class="mt-4">
            <x-label for="id_unidad" :value="__('Unidad')" />
            <div class="alerta mb-3 xl:w-full">
                <select 
                    name="id_unidad" 
                    id="id_unidad" 
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                >
                    <option value="">-- Selecciona una unidad --</option>
                    @foreach ($unidades as $id => $nombre)
                        <option {{ $producto->id_unidad == $id ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>

                @error('id_unidad')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <x-label for="activo" :value="__('Status')" />

            Activo: <x-input 
                id="activo" 
                type="radio" 
                name="activo" 
                value="1" required autofocus checked
            />

            Inactivo: <x-input 
                id="activo" 
                type="radio" 
                name="activo" 
                value="2" required autofocus 
            />

            @error('activo')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Registrar') }}
            </x-button>
        </div>
    