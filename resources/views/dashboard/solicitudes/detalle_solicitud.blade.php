<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle de la solicitud') }}
            </h2>
        </center>
    </x-slot>
        
            @include('dashboard.partials.session-flash-status')
            @if(Session::has('msg1'))
                <div class="bg-green-500 font-bold text-white w-auto text-center" role="alert">
                    {{ Session::get('msg1') }}
                </div>
            @endif
            @if(Session::has('msg2'))
                <div class="bg-green-500 font-bold text-white w-auto text-center" role="alert">
                    {{ Session::get('msg2') }}
                </div>
            @endif
    
                <div class="flex flex-row justify-evenly mt-2 w-auto">
                    <div class="w-auto">
                        <h3 class="font-semibold my-1">Datos de la solicitud</h3>
                        @foreach ($sol as $soli)
                            <h4><span class="font-semibold">Codigo del producto: </span>{{ $soli->codigo_solicitud }}</h4>
                            <h4><span class="font-semibold">Fecha de creacion: </span>{{ \Carbon\Carbon::parse($soli->created_at )->format('Y-m-d')}}</h4>

                            @if ($soli->id_status == 3)
                                <h4><span class="font-semibold">Estatus: </span>{{ $soli->nombre_status }}</h4>
                            @endif

                            @if ($soli->id_status == 1 || $soli->id_status == 2)
                                <form action="{{ route('modificar-solicitud',['id'=>$soli->codigo_solicitud]) }}" method="POST" name="nuevo" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <h4 class="font-semibold">Estatus: 
                                    <select 
                                        name="id_status" 
                                        id="id_status"
                                        class="w-60 px-3 py-1 rounded-lg appearance-none text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    >
                                        <option value="">-- Selecciona el estatus --</option>
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->id }}">{{ $estado->nombre_status }}</option>
                                        @endforeach
                                    </select>
                                    </h4>
                            @endif
                        @endforeach
                    </div>
                    <div class="w-auto"> 
                        <h3 class="font-semibold my-1">Datos del usuario</h3>
                        @foreach ($sol as $solicita)
                            <h4><span class="font-semibold">Nombre: </span>{{ $solicita->name }} {{ $solicita->app }} {{ $solicita->apm }}</h4>
                            <h4><span class="font-semibold">Email: </span>{{ $solicita->email }}</h4>
                            <h4><span class="font-semibold">Telefono: </span>{{ $solicita->telefono }}</h4>
                        @endforeach
                    </div>

                </div>

                <center>
                    <div class='overflow-x-auto w-full'>
                        <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                            <thead class="bg-gray-900">
                                <tr class="text-white text-left">
                                    <th class="font-semibold text-sm uppercase px-6 py-4"> Codigo producto </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Nombre Producto </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Cantidad </th>
                                    <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Categoria </th>
                                    @foreach ($status as $detalle)
                                        @if ($detalle->id_status == 2)
                                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Verificacion </th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border-collapse border-emerald-900">
                                @foreach ($info as $detalle)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-3">
                                                <div>
                                                    <p> {{ $detalle->codigo_solicitud }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <p class=""> {{ $detalle->nombre_prod }} </p>
                                        </td>
                                        <td class="px-6 py-4 text-center"> {{ $detalle->cantidad }} </td>
                                        <td class="px-6 py-4 text-center"> {{ $detalle->nombre_categoria }} </td>
                                        @if ($detalle->id_status == 2)
                                            <td class="px-6 py-4 text-center"> 
                                                <div id="prueba">
                                                    <input 
                                                        class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-none mr-2 cursor-pointer"
                                                        type="checkbox"
                                                        name="nombres[]"
                                                        value="{{$detalle->id}},{{$detalle->cantidad}}" 
                                                        id="flexCheckDefault{{$detalle->id}}"
                                                    >
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="max-w-4xl w-full flex flex-row justify-between border-2 border-gray-200 bg-gray-100 rounded-lg py-2 px-2">
                            <div class="font-bold text-lg mx-6">Total</div>
                            <div class="font-bold text-lg mx-6">{{ $total}} productos</div>
                        </div>
                        <div class="max-w-4xl w-full flex flex-row justify-between bg-gray-100 rounded-lg py-2 px-2">
                            <div class="font-bold text-lg mx-6">
                                <a 
                                    href="{{ route('solicitudes-index') }}"
                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    Cancelar
                                </a>
                            </div>
                            <div class="font-bold text-lg mx-6">
                                <input type="submit" value="Guardar" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" />
                            </div>
                        </div>
                        <hr class="max-w-4xl w-full flex flex-row justify-between bg-gray-700 rounded-lg py-0">
                    </div>
                </center>
            </form>
            </div>
        </div>
    </div>
</x-app-layout>