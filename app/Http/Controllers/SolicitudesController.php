<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SolicitudesController extends Controller
{
    
    
    public function solicitudesIndex() {
        $solicitudes = Solicitud::join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('status', 'solicitudes.id_status', '=', 'status.id')
            ->join('areas', 'users.id_area', 'areas.id')
            ->select(
                'areas.nombre_area',
                'solicitudes.id_solicitud',
                'solicitudes.id_status',
                'solicitudes.num_productos',
                'solicitudes.codigo_solicitud',
                'users.name',
                'users.app',
                'users.apm',
                'status.nombre_status',
                'solicitudes.created_at'
            )
            ->orderBy('solicitudes.created_at', 'desc')
            ->paginate(5);

        return view('dashboard.solicitudes.index', compact('solicitudes'));
    }

    public function detalle_solicitud(Request $request, Solicitud $id) {
        $estados = DB::table('status')
            ->select('nombre_status', 'id')
            ->where('id', 3)
            ->get();

        $sol = DB::table('solicitudes')
            ->join('status', 'solicitudes.id_status', '=', 'status.id')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->select(
                'solicitudes.id_solicitud', 
                'solicitudes.codigo_solicitud', 
                'solicitudes.created_at', 
                'solicitudes.id_status',
                'status.nombre_status', 
                'users.name', 
                'users.app', 
                'users.apm',
                'users.email',
                'users.telefono' 
            )
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->get();

        $info = DB::table('solicitudes')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->select(
                'solicitudes.id_solicitud',
                'solicitudes.id_status',
                'solicitudes.codigo_solicitud',
                'productos.id',
                'productos.nombre AS nombre_prod' ,
                'productos.codigo_producto',
                'detalle_solicitudes.cantidad',
                'users.name',
                'categorias.nombre as nombre_categoria'
            )
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->get();

        $total = DB::table('solicitudes')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->select(DB::raw('sum(detalle_solicitudes.cantidad) as Total'))
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->first();
        
        $status = DB::table('solicitudes')
            ->select('id_status')
            ->where('codigo_solicitud', $id->codigo_solicitud)
            ->get();


        return view('dashboard.solicitudes.detalle_solicitud', compact('estados', 'sol', 'info', 'total', 'status'));
    }

    public function modificarSolicitud(Solicitud $id, Request $request) {
        $con = Solicitud::find($id->codigo_solicitud);
        
        $solicitudes = Solicitud::join('users', 'solicitudes.id_usuario', '=', 'users.id')
        ->join('status', 'solicitudes.id_status', '=', 'status.id')
        ->join('areas', 'users.id_area', 'areas.id')
        ->select(
            'areas.nombre_area',
            'solicitudes.id_solicitud',
            'solicitudes.id_status',
            'solicitudes.num_productos',
            'solicitudes.codigo_solicitud',
            'users.name',
            'users.app',
            'users.apm',
            'status.nombre_status',
            'solicitudes.created_at'
        )
        ->orderBy('solicitudes.created_at', 'desc')
        ->paginate(5);
        
        $datos = DB::table('solicitudes')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->select(
                'solicitudes.id_solicitud',
                'solicitudes.codigo_solicitud',
                'users.name',
                'users.app',
                'users.apm',
                'solicitudes.created_at',
                'users.email',
                'productos.codigo_producto',
                'detalle_solicitudes.cantidad',
                'productos.nombre as nombre_producto',
                'categorias.nombre as nombre_categoria'
            )
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->get();

        $enca = DB::table('solicitudes')
            ->select('codigo_solicitud', 'created_at')
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->first();
        
        $todo = DB::table('solicitudes')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->select(
                'users.name',
                'users.app',
                'users.apm',
                'users.email',
                'solicitudes.created_at'
            )
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->first();

        $data = DB::table('solicitudes')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->select(
                'solicitudes.id_solicitud',
                'solicitudes.codigo_solicitud',
                'users.name',
                'users.app',
                'users.apm',
                'solicitudes.created_at',
                'users.email',
                'productos.codigo_producto',
                'detalle_solicitudes.cantidad',
                'productos.nombre as nombre_producto',
                'categorias.nombre as nombre_categoria'
            )
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->get();
    
        //Guardar el nuevo status
        
        if ($request->id_status == null) {
            $con->id_status = $id->id_status;
            return back()->with('msg2', 'Solicitud actualizada');
        } else {
            $con->id_status = $request->id_status;
            $con->save();
            
            if ($request->id_status == 3) {
                $data = array(
                    'ejemplo' => '',
                    'nombre' => $data,
                'correo' => 'al221910354@gmail.com',
                'asunto' => $enca,
                'mensaje' => ''
            );
            
            Mail::send('dashboard.emails.email3', $data, function ($message) use ($todo) {
                $message->to($todo->email, $todo->name)
                ->subject('Solicitud finalizada');
                $message->from('al221910354@gmail.com', 'Inventario Grupo IIS');
            });
            
            if (Mail::failures()) {
                return "error!!";
            } 
            
        }
            return back()->with('msg2', 'Solicitud finalizada');
        }
    }
}
