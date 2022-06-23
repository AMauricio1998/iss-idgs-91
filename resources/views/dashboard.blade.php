<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="container mx-auto md:grid md:grid-cols-3 mt-2 gap-10 p-5" style="height: 500px">
        @include('dashboard.graficas.grafica')  
    </main> 
</x-app-layout>
