<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
        </x-slot>
        <h4 class="text-indigo-600 font-black text-4xl">Registrate y Administra tus <span class="text-black">Solicitudes</span></h4>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="app" :value="__('Apellido Paterno')" />

                <x-input id="app" class="block mt-1 w-full" type="text" name="app" :value="old('app')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="apm" :value="__('Apellido Materno')" />

                <x-input id="apm" class="block mt-1 w-full" type="text" name="apm" :value="old('apm')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="telefono" :value="__('Num. Telefono')" />

                <x-input id="telefono" class="block mt-1 w-full" type="tel" name="telefono" :value="old('telefono')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="colonia" :value="__('Colonia o localidad')" />

                <x-input id="colonia" class="block mt-1 w-full" type="text" name="colonia" :value="old('colonia')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="calle" :value="__('Calle')" />

                <x-input id="calle" class="block mt-1 w-full" type="text" name="calle" :value="old('calle')" required autofocus />
            </div>
            
            <div class="mt-4">
                <x-label for="num_calle" :value="__('Numero')" />

                <x-input id="num_calle" class="block mt-1 w-full" type="number" name="num_calle" :value="old('num_calle')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="cod_postal" :value="__('Codigo Postal')" />

                <x-input id="cod_postal" class="block mt-1 w-full" type="number" name="cod_postal" :value="old('cod_postal')" required autofocus />
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
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
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
                        <option value="">-- Selecciona un municipio --</option>
                    </select>
                </div>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
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
                        <option value="{{ $id }}">{{ $nombre_area }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4">
                {!! htmlFormSnippet([
                    "size" => "normal",
                    "tabindex" => "3",
                    "callback" => "callbackFunction",
                    "expired-callback" => "expiredCallbackFunction",
                    "error-callback" => "errorCallbackFunction",
                ]) !!}
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
<script type="text/javascript" src="{{ asset('/js/select-edo.js') }}"></script>