<?php

namespace App\Http\Controllers\UserFront;

// use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\DetalleSolicitud;
use App\Models\Producto;
use App\Models\ProductosImagen;
use App\Models\Solicitud;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CarritoController extends Controller
{
    public function nueva_solicitud(Request $request)
    {
        $productos = Producto::with('categorias', 'unidades')
            ->where('stock', '>', 1);

            if ($request->has('search')) {
            $productos = $productos->where('nombre', 'LIKE', '%'. request('search') .'%');
        }

        $productos = $productos->take(10)->paginate(10);

            return view('users.solicitudes.nueva_solicitud', compact('productos'));
    }

    public function add($id){

        $producto = Producto::find($id);
        
        \Cart::session(Auth::user()->id)->add(array(
            'id' => $producto->id,
            'name' => $producto->nombre,
            'price' => 1,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $producto
        ));

        return back()->with('add-producto','Producto agregado a la solicitud!');
    }

    public function informacion_cart() {
        $user = DB::table('users')
                ->select('users.name', 'users.id' ,'users.app', 'users.apm', 'users.email', 'users.cod_postal', 'users.colonia', 'users.calle')
                ->where('users.id', '=', Auth::user()->id)
                ->get();

        $cartItems = \Cart::session(Auth::user()->id)->getContent();

        return view('users.carrito.carrito', compact('cartItems', 'user')); 
    }

    public function eliminar_carrito(){
     
        \Cart::session(Auth::user()->id)->clear();
        
        return redirect()->route('nueva-solicitud');
    }

    public function actualizar(Request $request, $id) {
        \Cart::session(Auth::user()->id)->update($id, [
            'quantity' => array(
                'relative' => false,
                'value' => request('quantity')
            ),
            
        ]);
        return back();
    }

    public function destruir($id) {
        \Cart::session(Auth::user()->id)->remove($id);
        
        return back();
    }

    public function store() {
        $solicitudes = Solicitud::all()->last();
        $newId = $solicitudes->id_solicitud + 1;

        $time = Carbon::now();
        $date = $time->format('Ymd');
        $numero = str_pad($newId, 4, 0, STR_PAD_LEFT);

        $cdSolicitud = $date.$numero;

        $cantidad = \Cart::session(auth()->user()->id)->getTotalQuantity();

        $solicitud = New Solicitud();
        $solicitud->id_solicitud = $newId;
        $solicitud->codigo_solicitud = $cdSolicitud;
        $solicitud->num_productos = $cantidad;
        $solicitud->id_usuario = auth()->user()->id;
        $solicitud->id_status = 1;
        $solicitud->save();

        $cartItems = \Cart::session(auth()->user()->id)->getContent();

        foreach($cartItems as $item) {
            $solicitud->codigo_solicitud = $cdSolicitud;
            $solicitud->detalle_solicitud()->attach($item->id,['cantidad'=> $item->quantity]);
        }
        \Cart::session(auth()->user()->id)->clear();
        return redirect()->route('solicitudes-index-user');
    }
    
    public function editar_solicitud($id) {
        $status = DB::table('status')
            ->select('nombre_status', 'id')
            ->get();
        
        $solicitud = DB::table('solicitudes')
            ->join('status', 'solicitudes.id_status', '=', 'status.id')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->select(
                'solicitudes.id_solicitud', 
                'solicitudes.codigo_solicitud', 
                'users.name', 
                'users.app', 
                'users.apm', 
                'users.telefono', 
                'users.email', 
                'status.nombre_status', 
                'solicitudes.created_at', 
                'solicitudes.id_status')
            ->where('solicitudes.codigo_solicitud', $id)
            ->get();

        $detalleSolicitud = DB::table('solicitudes')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->select(
                'solicitudes.id_solicitud', 
                'solicitudes.codigo_solicitud', 
                'solicitudes.id_status',
                'productos.nombre', 
                'productos.codigo_producto', 
                'detalle_solicitudes.id_producto', 
                'detalle_solicitudes.cantidad', 
                'users.name', 
                'categorias.nombre as nombre_categoria')
            ->where('solicitudes.codigo_solicitud', $id)
            ->get();
    
        // $total = DB::table('solicitudes')
        //     ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
        //     ->select(DB::raw('sum(detalle_solicitudes.cantidad) as Total'))
        //     ->where('solicitudes.codigo_solicitud', $id)
        //     ->first();
        $total = DetalleSolicitud::where('codigo_solicitud', $id)->sum('cantidad');

        $soli = DB::table('solicitudes')
            ->select('id_solicitud', 'codigo_solicitud')
            ->where('codigo_solicitud', $id)
            ->get();

        return view('users.solicitudes.editar-solicitud', compact('status', 'solicitud', 'detalleSolicitud', 'total', 'soli'));
    }

    public function eliminar_producto($id, $codigo) {

        $actua = DB::table('detalle_solicitudes')
            ->where('detalle_solicitudes.codigo_solicitud', $codigo)
            ->where('id_producto', $id)
            ->select('cantidad')
            ->first();

        $actuas = DB::table('solicitudes')
            ->where('solicitudes.codigo_solicitud', $codigo)
            ->select('num_productos')
            ->first();

        $res = $actuas->num_productos - $actua->cantidad;

        $descuento = DB::table('solicitudes')
            ->where('codigo_solicitud', $codigo)
            ->update(['num_productos' => $res]);

        $borrar = DB::table('detalle_solicitudes')
            ->where('detalle_solicitudes.codigo_solicitud', $codigo)
            ->where('id_producto', $id)
            ->delete();

        return Redirect::back()->with('msg-delete', 'Producto eliminado con exito!');
    }

    public function productos_editar(Request $request, $codigo){

        $solicitud = DB::table('solicitudes')
        ->select('id_solicitud','codigo_solicitud')
        ->where('codigo_solicitud',$codigo)
        ->get();

        $productos = Producto::with('categorias', 'unidades')
            ->where('stock', '>', 1);

        if ($request->has('search')) {
            $productos = $productos->where('nombre', 'LIKE', '%'. request('search') .'%');
        }

        $productos = $productos->take(10)->paginate(10);

        return view('users.solicitudes.nueva_solicitud', compact('productos', 'solicitud'));
    }

    public function mostrar_carrito($codigo){
        $cartItems = \Cart::session(auth()->user()->id)->getContent();
        $user = DB::table('users')
                    ->select('users.name', 'users.id', 'users.app', 'users.apm', 'users.email', 'users.cod_postal', 'users.colonia', 'users.calle')
                    ->where('users.id', '=', Auth::user()->id)
                    ->get();
        
        $cdSolicitud = DB::table('solicitudes')
        ->select('id_solicitud','codigo_solicitud')
        ->where('codigo_solicitud',$codigo)
        ->get();

        return view('users.carrito.carrito', compact('cartItems', 'cdSolicitud', 'user')); 
    }

    public function solicitudUpdate($codigo){
        $solicitud = New Solicitud();
        $solicitud->codigo_solicitud = (int)$codigo;
        $cartItems = \Cart::session(auth()->user()->id)->getContent();
        $cantidad = \Cart::session(auth()->user()->id)->getTotalQuantity();

        $agregados = DB::table('solicitudes')
            ->select('num_productos')
            ->where('codigo_solicitud',$codigo)
            ->first();

        $nueva_cantidad = $agregados->num_productos + $cantidad;

        //---- Actualiza la tabla solicitudes -----
        $update = DB::table('solicitudes')
            ->where('codigo_solicitud',$codigo)
            ->update(['num_productos' => $nueva_cantidad]);
        
        //---- Itera sobre la cantidad e productos y relaciona datos con  el detalle de solicitud---------
        foreach($cartItems as $item){
            $solicitud->codigo_solicitud = $codigo;
            $solicitud->detalle_solicitud()->attach($item->id,['cantidad'=> $item->quantity]);
        }

        \Cart::session(auth()->user()->id)->clear();
        return redirect()->route('solicitudes-index-user');
    }
}
