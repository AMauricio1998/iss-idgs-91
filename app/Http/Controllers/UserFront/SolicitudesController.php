<?php

namespace App\Http\Controllers\UserFront;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SolicitudesController extends Controller
{
    public function solicitudes() {
        $solicitudes = Solicitud::join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('status', 'solicitudes.id_status', '=', 'status.id')
            ->join('areas', 'users.id_area', 'areas.id')
            ->select('solicitudes.id_solicitud', 'solicitudes.id_status', 'solicitudes.num_productos', 'users.name', 'users.app', 'status.nombre_status', 'solicitudes.codigo_solicitud', 'solicitudes.created_at', 'areas.nombre_area')
            ->where('solicitudes.id_usuario', auth()->user()->id)
            ->orderBy('solicitudes.created_at', 'desc')
            ->paginate(7);

            return view('users.solicitudes.index', compact('solicitudes'));
    }

    public function reporte_solicitud(Request $request, Solicitud $id) {
        $encabezados = DB::table('solicitudes')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('areas', 'users.id_area', '=', 'areas.id')
            ->select('solicitudes.created_at', 'solicitudes.id_solicitud', 'solicitudes.codigo_solicitud', 'users.email' ,'users.name', 'users.app', 'users.apm', 'areas.nombre_area')
            ->selectRaw('count(detalle_solicitudes.cantidad) as cantidad')
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->groupBy('solicitudes.created_at', 'solicitudes.id_solicitud', 'solicitudes.codigo_solicitud', 'users.email', 'users.name', 'users.app', 'users.apm', 'areas.nombre_area')
            ->first();

        // ------- Actualiza status de la solicitud ----------
        $estatus_update = DB::table('solicitudes')
            ->where('codigo_solicitud', $id->codigo_solicitud)
            ->update(['id_status' => 2]);

        $data = array(
            'ejemplo' => '',
            'nombre' => $encabezados,
            'correo' => 'al221910354@gmail.com',
            'asunto' => 'Se registro una nueva solicitud',
            'mensaje' => 'Nueva solicitud'
        );

        $todo = DB::table('solicitudes')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->select(
                'users.name',
                'users.app',
                'users.apm',
                'solicitudes.created_at',
                'users.email'
            )
            ->where('solicitudes.codigo_solicitud', $id->codigo_solicitud)
            ->first();

        // --- Reportar al usuario la nueva solicitud --------------
        Mail::send('users.email-user', $data, function ($message) use ($encabezados){
            $message->to('al221910354@gmail.com', 'Almacén')
                    ->subject('Nueva Solicitud');
            $message->from('al221910354@gmail.com', 'Inventario Grupo IIS');
        });

        Mail::send('users.email-soli-proceso', $data, function ($message) use ($todo) {
            $message->to($todo->email, $todo->name)
                ->subject('Solicitud en proceso');
            $message->from('al221910354@gmail.com', 'Inventario Grupo IIS');
        });

        if (Mail::failures()) {
            return "error!!";
        } else {
            return redirect()->route('solicitudes-index-user')->with('message-confirm', 'Se envio el correo con los datos de tu solicitud');
        }
    }
}
