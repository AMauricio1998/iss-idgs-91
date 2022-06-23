
<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edicion de usuarios') }}
            </h2>
        </center>
    </x-slot>
    
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-6 bg-gray-200">
        
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @include('dashboard.partials.session-flash-status')

            <form action="{{ route('productos-update', $producto->id) }}" method="POST">
                @method('PUT')
                @include('dashboard.productos._form')
            </form>
            
        </div>
                <br>
                <center>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('En esta seccion puedes cargar una imagen para el producto') }}
                    </h2>
                </center>
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form action="{{ route('productos-imagen', $producto) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input 
                                id="imagen" 
                                class="block mt-1 w-full" 
                                type="file" 
                                name="imagen"  
                                required autofocus 
                            />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Cargar imagen') }}
                            </x-button>
                        </div>
                    </form>
                </div>
                <br><br>
    </div>
</x-app-layout>

<script type="text/javascript" src="{{ asset('/js/select-edo.js') }}"></script>