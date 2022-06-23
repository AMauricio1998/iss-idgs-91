
<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Registro de nuevas areas') }}
            </h2>
        </center>
    </x-slot>
    
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-6 bg-gray-200">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @include('dashboard.partials.session-flash-status')

            <form action="{{ route('area-create-nueva') }}" method="POST" enctype="multipart/form-data">
                @include('dashboard.areas._form')
            </form>
        </div>
    </div>
    <br>
</x-app-layout>
