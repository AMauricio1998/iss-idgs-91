<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Illuminate\Http\Request;

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
        
        return response()->json($solicitudes);
    }
}
