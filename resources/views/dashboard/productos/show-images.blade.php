<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Imagenes del producto: ') }} <span
                    class="text-indigo-700 font-bold">{{ $producto->nombre }}</span>
            </h2>
        </center>
    </x-slot>
        
    <!-- component -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-wrap -m-4">
                    @forelse ($imagenes as $image)
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <div class="flex relative">
                            <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center"
                                src="{{ asset('/images/' . $image->imagen) }}">
                            <div
                                class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">Opciones</h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $producto->nombre }}</h1>
                                <a 
                                    href="#" 
                                    class="text-white bg-gray-700 leading-relaxed rounded-full py-2 px-2 font-semibold hover:bg-gray-400">
                                    Eliminar imagen
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                     <div class="bg-red-400 w-full rounded-lg text-center text-white font-bold">Este producto no tiene imagenes asociadas</div>
                    @endforelse
                </div>
            </div>
        </section>
        <br>
                
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form action="{{ route('productos-imagen', $producto) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-label>Selecciona una imagen</x-label>
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

</x-app-layout>
