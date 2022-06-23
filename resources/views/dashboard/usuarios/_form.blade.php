
        @csrf

        <!-- Name -->
        <div>
            <x-label for="name" :value="__('Nombre')" />

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)"  autofocus />

            @error('name')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="app" :value="__('Apellido Paterno')" />

            <x-input id="app" class="block mt-1 w-full" type="text" name="app" :value="old('app', $user->app)" required autofocus />

            @error('app')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="apm" :value="__('Apellido Materno')" />

            <x-input id="apm" class="block mt-1 w-full" type="text" name="apm" :value="old('apm', $user->apm)" required autofocus />

            @error('apm')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="telefono" :value="__('Num. Telefono')" />

            <x-input id="telefono" class="block mt-1 w-full" type="tel" name="telefono" :value="old('telefono', $user->telefono)" required autofocus />

            @error('telefono')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="colonia" :value="__('Colonia o localidad')" />

            <x-input id="colonia" class="block mt-1 w-full" type="text" name="colonia" :value="old('colonia', $user->colonia)" required autofocus />

            @error('colonia')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="calle" :value="__('Calle')" />

            <x-input id="calle" class="block mt-1 w-full" type="text" name="calle" :value="old('calle', $user->calle)" required autofocus />

            @error('calle')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="mt-4">
            <x-label for="num_calle" :value="__('Numero')" />

            <x-input id="num_calle" class="block mt-1 w-full" type="number" name="num_calle" :value="old('num_calle', $user->num_calle)" required autofocus />

            @error('num_calle')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="cod_postal" :value="__('Codigo Postal')" />

            <x-input id="cod_postal" class="block mt-1 w-full" type="number" name="cod_postal" :value="old('cod_postal', $user->cod_postal)" required autofocus />
            
            @error('cod_postal')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="estado" :value="__('Estado')" />
            <div class="alerta mb-3 xl:w-full">
                <select 
                    name="estado" 
                    id="estado" 
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                >
                    <option value="">-- Selecciona un estado --</option>
                    @foreach ($estados as $id => $nombre)
                        <option {{ $user->estado == $id ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>

                @error('estado')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>
        </div>
        
        <div class="mt-4">
            <x-label for="municipio" :value="__('Municipio')" />
            <div class="mb-3 xl:w-full">
                <select 
                    name="municipio" 
                    id="municipio" 
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                >
                    <option value="{{ $user->municipio }}">{{ $user->municipio }}</option>
                </select>

                @error('municipio')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />

            @error('email')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password" 
                    :value="old('password', $user->password)"
                />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

        <div class="mt-4">
            <x-label for="id_area" :value="__('Area')" />
            <div class="mb-3 xl:w-full">
                <select 
                    name="id_area" 
                    id="id_area" 
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                >
                    <option value="">-- Selecciona tu area --</option>
                @foreach ($areas as $nombre_area => $id)
                    <option {{ $user->id_area == $id ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $nombre_area }}</option>
                @endforeach
                </select>

                @error('id_area')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>
        </div>
        
        <div class="mt-4">
            <x-label for="id_rol" :value="__('Rol')" />
            <div class="mb-3 xl:w-full">
                <select 
                    name="id_rol" 
                    id="id_rol" 
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                >
                    <option value="">-- Selecciona tu rol --</option>
                @foreach ($roles as $nombre_rol => $id)
                    <option {{ $user->id_rol == $id ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $nombre_rol }}</option>
                @endforeach
                </select>

                @error('id_rol')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>
        </div>
        
        <div class="mt-4">
            <x-label for="status" :value="__('Status')" />
            <div class="mb-3 xl:w-full">
                <select 
                    name="status" 
                    id="status" 
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                >
                    <option value="1" selected>-- Activo --</option>
                    <option value="2">-- Inactivo --</option>
                </select>

                @error('status')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Registrar') }}
            </x-button>
        </div>
    