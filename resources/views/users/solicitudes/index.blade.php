<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Estas son tus solicitudes {{ Auth::user()->name }} {{ Auth::user()->app }} 
            </h2>
        </center>
    </x-slot>

    <div class="min-h-screen bg-white py-5">
        <div class='overflow-x-auto w-full'>
            @if(Session::has('message-confirm'))
                <div class="bg-green-400 font-bold uppercase text-white text-center" role="alert">
                    {{ Session::get('message-confirm') }}
                </div>
            @endif
            <div class="mx-32 py-2" id="proccess">
                <a 
                    href="{{ route('nueva-solicitud') }}"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                >
                <i class="fa-solid fa-plus"></i> Nueva solicitud
                </a>
            </div>
            <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                    <tr class="text-white text-left">
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Codigo de solicitud </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Productos totales </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Usuario </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Area </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Status </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> PDF-Editar </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Enviar </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($solicitudes as $solicitud)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <p> {{ $solicitud->codigo_solicitud }} </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-center"> {{ $solicitud->num_productos }} </p>
                            </td>
                            <td class="px-6 py-4 text-center"> {{ $solicitud->name }} {{ $solicitud->app }} </td>
                            <td class="px-6 py-4 text-center"> {{ $solicitud->nombre_area }} </td>
                            <td class="px-6 py-4 text-center">  
                            @if ($solicitud->nombre_status == 'Creada')
                                <span class="font-bold bg-blue-400 py-1 px-1 rounded">{{ $solicitud->nombre_status }}</span>
                            @endif
                            @if ($solicitud->nombre_status == 'En proceso')
                                <span class="font-bold bg-yellow-400 py-1 px-1 rounded">{{ $solicitud->nombre_status }}</span>
                            @endif
                            @if ($solicitud->nombre_status == 'Finalizada')
                                <span class="font-bold bg-green-400 py-1 px-1 rounded">{{ $solicitud->nombre_status }}</span>
                            @endif
                            </td>
                            @if ($solicitud->id_status == 1)
                                <td class="px-6 py-4 text-center flex flex-row justify-center"> 
                                    <a 
                                        href="{{ route('editar_solicitud', ['codigo' => $solicitud->codigo_solicitud]) }}"
                                        class="bg-green-400 font-bold py-4 px-2 rounded-lg flex flex-raw mx-1"
                                        title="PDF"
                                    >
                                        <i class="fa-solid fa-pen-to-square fa-xl"></i>
                                    </a>
                                </td>
                            @else
                            <td class="px-6 py-4 text-center flex flex-row justify-center"> 
                                    <a 
                                        href="{{ route('pdf_solicitudes', ['id' => $solicitud->codigo_solicitud]) }}"
                                        class="bg-red-400 font-bold py-5 px-4 rounded-lg flex flex-raw mx-1"
                                        title="PDF"
                                    >
                                        <i class="fa-solid fa-file-pdf fa-xl"></i>
                                    </a>
                                </td>
                            @endif
                            @if ($solicitud->id_status == 2 || $solicitud->id_status == 3)
                                <td class="px-6 py-4 text-center">
                                    <a 
                                        role="button"
                                        class="hover:bg-blue-400 bg-blue-500 font-bold py-5 px-3 rounded-lg flex flex-raw mx-1"
                                        title="Ver"
                                        id="open-btn-send"
                                        data-modal-toggle="popup-modal-send"
                                    >
                                        <i class="fa-solid fa-xl fa-paper-plane"></i>
                                    </a>

                                    {{--  Modal  --}}
                                    <center>
                                        <div id="popup-modalSend" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modalSend">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                                    </button>
                                                    <div class="p-6 text-center">
                                                        <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Solicitud en proceso</h3>
                                                        <h4 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Tu solicitud ya fue enviada</h4>
                                                        <button id="ok-btn-send" data-modal-toggle="popup-modalSend" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Ok
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                {{--  Fin modal  --}}
                                
                                </td>
                            @else
                                <td class="px-6 py-4 text-center"> 
                                    <a 
                                        href="{{ route('reporte_solicitud', ['id' => $solicitud->codigo_solicitud]) }}" 
                                        class="bg-indigo-400 font-bold py-4 px-2 rounded-lg flex flex-raw mx-1"
                                        title="Enviar"
                                    >
                                        <i class="fa-solid fa-paper-plane fa-xl"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @empty 
                        <div class="text-center bg-red-400 mx-1 my-1 rounded-lg py-1">
                            <span class="text-center text-white font-bold"> No hay solicitudes </span>
                        </div> 
                    @endforelse
                </tbody>
            </table>

            <center>
                {{--  {{ $usuarios->links() }}  --}}
            </center>

        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    
document.addEventListener('DOMContentLoaded', function() {
    let modal = document.getElementById('popup-modalSend');
    let btn = document.querySelectorAll("#open-btn-send");
    let button = document.getElementById("ok-btn-send");

    if (btn !== null) {
        const modalClick = function (event) {
            modal.style.display = "block"
        }
    
        button.addEventListener('click', function() {
            modal.style.display = "none";
        });
    
        btn.forEach( boton => {
            boton.addEventListener('click', modalClick);
        })
    
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

});
</script>