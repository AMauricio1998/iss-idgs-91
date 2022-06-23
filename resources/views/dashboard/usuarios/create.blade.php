
<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Registro de nuevos usuarios') }}
            </h2>
        </center>
    </x-slot>
    
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-6 bg-gray-200">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @include('dashboard.partials.session-flash-status')

            <form action="{{ route('usuario-create-nuevo') }}" method="POST">
                @include('dashboard.usuarios._form')
            </form>
        </div>
    </div>
    <br>
</x-app-layout>

<script type="text/javascript" src="{{ asset('/js/select-edo.js') }}"></script>