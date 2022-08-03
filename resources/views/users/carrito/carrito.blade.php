<style>
    .paypal1 {color: #003087; font-size: 22px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-style: italic;}
    .paypal2 {color: #009CDE; font-size: 22px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-style: italic;}
    .paypal3 {color: #000000; font-size: 17px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
    .paypal4 {color: #fafafa; font-size: 17px; font-family: Arial, Helvetica, sans-serif; }
    .myButton0a {width: 350px; background-color:#FFC439; border-radius:4px; display:inline-block; cursor:pointer; padding:12px; text-align:center; text-decoration:none; margin-bottom: 5px; }
    .myButton0a:hover {background-color:#fcba1f; }
    .myButton0a:active {position:relative; top:1px; }
    .myButton1a {width: 250px; background-color:#000000; border-radius:4px; display:inline-block; cursor:pointer; padding:12px; text-align:center; text-decoration:none; }
    .myButton1a:hover {background-color:#2b2b2b; }
    .myButton1a:active {position:relative; top:1px; }

</style>

<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Informacion de tu carrito de solicitudes 
            </h2>
        </center>
    </x-slot>

    <!-- component -->
<div class="flex justify-center my-6">  
    <div class="flex flex-col w-full p-14 rounded-lg text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5 relative">
        @if(Session::has('msg-paypal'))
            <div class="bg-red-400 font-bold uppercase text-white text-center" role="alert">
                {{ Session::get('msg-paypal') }}
            </div>
        @endif
        @if(Session::has('msg-paypal2'))
            <div class="bg-green-400 font-bold uppercase text-white text-center" role="alert">
                {{ Session::get('msg-paypal2') }}
            </div>
        @endif
        <div class="rounded-lg flex flex-rows justify-around bg-gradient-to-r from-blue-400 to-blue-700 -top-3 w-2/3 items-center mx-28 absolute h-14">
            <div>
                <a href="{{ route('eliminar-carrito') }}" class="hover:bg-blue-600 rounded-lg py-1 px-1 border-2 border-gray-300 opacity-100 bg-blue-400 font-semibold text-white">
                    <i class="fa-solid fa-broom-ball"></i> Vaciar solicitud
                </a>
            </div>
            <div>
                <span class="font-bold text-white text-center">Productos agregados</span>
            </div>
            <div>
                @if (isset($cdSolicitud))
                    @foreach ($cdSolicitud as $cd)
                        <a href="{{ route('editar-solicitud', $cd->codigo_solicitud) }}" class="hover:bg-blue-600 rounded-lg py-1 px-1 border-2 border-gray-300 opacity-100 bg-blue-400 font-semibold text-white">
                            <i class="fa-solid fa-file"></i> Actualizar solicitud
                        </a>
                    @endforeach
                @else
                    <a href="{{ route('store-item') }}" class="hover:bg-blue-600 rounded-lg py-1 px-1 border-2 border-gray-300 opacity-100 bg-blue-400 font-semibold text-white">
                        <i class="fa-solid fa-file"></i> Generar solicitud
                    </a>
                @endif
            </div>
        </div> 
    <div class="flex-1 mt-1">
      <table class="w-full text-sm lg:text-base" cellspacing="0">
        <thead>
          <tr class="h-12 uppercase">
            <th class="hidden md:table-cell"></th>
            <th class="text-left">Producto</th>
            <th class="lg:text-right text-left pl-5 lg:pl-0">
              <span class="lg:hidden" title="Quantity">Qtd</span>
              <span class="hidden lg:inline text-center">Cantidad</span>
            </th>
            <th class="text-center md:table-cell">Actualizar</th>
            <th class="text-center md:table-cell">Eliminar</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($cartItems as $item)
            <form action="{{ route('actualizar-cart', ['id' => $item->id]) }}" method="GET">
            <tr>
                <td class="hidden pb-4 md:table-cell">
                    <a href="#">
                        <img src="https://www.bicifan.uy/wp-content/uploads/2016/09/producto-sin-imagen.png" class="w-20 rounded" alt="Thumbnail">
                    </a>
                </td>
                <td>
                    <a href="#">
                        <p class="mb-2 md:ml-4 font-semibold">{{ $item->name }}</p>
                        <span type="submit" class="text-gray-700 md:ml-4 hover:text-black">
                            <small>(Remove item)</small>
                        </span>
                    </a>
                </td>
                <td class="justify-center md:justify-end md:flex mt-10">
                    <div class="w-20 h-10">
                        <div class="relative flex flex-row w-full h-8">
                                <input type="number" min="1" name="quantity" value="{{ $item->quantity }}"
                                    class="w-full rounded-lg font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" 
                                />
                            </div>
                        </div>
                    </td>
                    <td class="text-center md:table-cell">
                        <button type="submit">
                            <i class="fa-solid fa-rotate"></i>
                        </button>
                    </td>
                    <td class="text-center md:table-cell">
                        <a href="{{ route('destruir-item',['id' => $item->id]  ) }}">
                            <i class="fa-solid fa-trash fa-xl"></i>
                        </a>
                    </td>
                </tr> 
            </form>
            @empty
                <br>
                <span class="font-bold text-white bg-red-400 rounded mx-1 my-1 px-1 py-1"><i class="fa-solid fa-heart-crack"></i> Tu carrito esta bacio</span>
            @endforelse
        </tbody>
    </table>
    @if (isset($cdSolicitud))
        <center>
            @foreach ($cdSolicitud as $codigo)
                <a 
                href="{{ route('productos_editar', $codigo->codigo_solicitud) }}"
                class="bg-blue-500 py-2 px-2 font-semibold rounded-lg border-2 border-gray-300 text-white hover:bg-blue-700">
                    Agregar mas productos
                </a>
            @endforeach
        </center>
    @else
        <center>
            <a 
                href="{{ route('nueva-solicitud') }}" 
                class="bg-blue-500 py-1 px-1 font-semibold rounded-lg border-2 border-gray-300 text-white hover:bg-blue-700">
                Agregar mas productos
            </a>
        </center>
    @endif
        <center class="mt-4">
                @foreach ($user as $usu)
                    <span class="hidden" id="user_id">{{ $usu->id }}</span> 
                    <div class="flex flex-col justify-center w-auto mt-2">
                        <p class="text-center">
                            Hola 
                                <span id="name" class="text-indigo-700 font-bold">{{ $usu->name }}</span> 
                                <span id="surname" class="text-indigo-700 font-bold">{{ $usu->app }} {{ $usu->apm }}</span>,
                            este servicio es gratuito, sin embargo puedes hacer una pequeña donacion de <span class="text-indigo-700 font-bold">$5</span> 
                        </p>
                        <p class="text-center">
                            para seguir adquiriendo productos, 
                            solo da click en el siguiente boton e ingresa tus datos. 
                        </p>
                    </div>
                @endforeach
                <div id="paypal-button-container" class="mt-2">
                    <a href="{{ route('paypal.pay') }}" class="myButton0a">
                        <span class="paypal1">Pay</span><span class="paypal2">Pal</span><span class="paypal3">.me</span>
                    </a>
                </div>
        </center>
    </div>
  </div>
</div>
</x-app-layout>