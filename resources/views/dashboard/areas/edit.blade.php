
<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edicion de areas') }}
            </h2>
        </center>
    </x-slot>
    
    @if(Session::has('msg-update'))
        <div class="bg-green-500 font-bold text-white w-auto text-center" role="alert">
            {{ Session::get('msg-update') }}
        </div>
    @endif
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-6 bg-gray-200">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @include('dashboard.partials.session-flash-status')

            <form action="{{ route('area-update', $area->id) }}" method="POST">
                @method('PUT')
                @include('dashboard.areas._form')
            </form>
            
        </div>
                <br><br>
    </div>
</x-app-layout>
