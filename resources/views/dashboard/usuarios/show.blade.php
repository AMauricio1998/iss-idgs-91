<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Datos del usuario') }}
            </h2>
        </center>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-6 bg-gray-200">

        <a 
            href="{{ route('usuario-index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"        >  
            Regresar al listado de usuarios
        </a>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Name -->
        <div>
            <x-label for="name" :value="__('Nombre')" />

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" readonly />

        </div>

        <div class="mt-4">
            <x-label for="app" :value="__('Apellido Paterno')" />

            <x-input id="app" class="block mt-1 w-full" type="text" name="app" value="{{ $user->app }}" readonly />
        </div>

        <div class="mt-4">
            <x-label for="apm" :value="__('Apellido Materno')" />

            <x-input id="apm" class="block mt-1 w-full" type="text" name="apm" value="{{ $user->apm }}" readonly />
        </div>

        <div class="mt-4">
            <x-label for="telefono" :value="__('Num. Telefono')" />

            <x-input id="telefono" class="block mt-1 w-full" type="tel" name="telefono" value="{{ $user->telefono }}" readonly />
        </div>

        <div class="mt-4">
            <x-label for="colonia" :value="__('Colonia o localidad')" />

            <x-input id="colonia" class="block mt-1 w-full" type="text" name="colonia" value="{{ $user->colonia }}" readonly />
        </div>

        <div class="mt-4">
            <x-label for="calle" :value="__('Calle')" />

            <x-input id="calle" class="block mt-1 w-full" type="text" name="calle" value="{{ $user->calle }}" readonly />
        </div>
        
        <div class="mt-4">
            <x-label for="num_calle" :value="__('Numero')" />

            <x-input id="num_calle" class="block mt-1 w-full" type="number" name="num_calle" value="{{ $user->num_calle }}" readonly />
        </div>

        <div class="mt-4">
            <x-label for="cod_postal" :value="__('Codigo Postal')" />

            <x-input id="cod_postal" class="block mt-1 w-full" type="number" name="cod_postal" value="{{ $user->cod_postal }}" readonly />
        </div>

        <div class="mt-4">
            <x-label for="estado" :value="__('Estado')" />
            <x-input id="estado" class="block mt-1 w-full" type="text" name="estado" value="{{ $user->estado }}" readonly />
        </div>
        
        <div class="mt-4">
            <x-label for="municipio" :value="__('Municipio')" />
            <x-input id="municipio" class="block mt-1 w-full" type="text" name="municipio" value="{{ $user->municipio }}" readonly />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" value="{{ $user->email }}" readonly />
        </div>

        <!-- Password -->

        <div class="mt-4">
            <x-label for="id_area" :value="__('Area')" />
            <x-input id="id_area" class="block mt-1 w-full" type="email" name="id_area" value="{{ $user->areas->nombre_area }}" readonly />
        </div>
        
        <div class="mt-4">
            <x-label for="id_rol" :value="__('Rol')" />
            <x-input id="id_rol" class="block mt-1 w-full" type="email" name="id_rol" value="{{ $user->roles->nombre_rol }}" readonly />
        </div>

        </div>
    </div>
    <br>

</x-app-layout>