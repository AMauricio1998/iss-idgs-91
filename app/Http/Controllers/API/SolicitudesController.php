<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

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

    public function pdf_solicitudes() {
        $solicitudes = Solicitud::join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('status', 'solicitudes.id_status', '=', 'status.id')
            ->select('solicitudes.id_solicitud', 'solicitudes.codigo_solicitud', 'solicitudes.created_at', 'users.name', 'status.nombre_status')
            ->get();

        $mytime = Carbon::now();
        $date = $mytime->format('d-m-Y');

        $pdf = App::make('dompdf.wrapper');
        $view = View::make('dashboard.solicitudes.reporte_solicitudes', compact('solicitudes', 'date'))->render();
        $pdf->loadHTML($view);
        return $pdf->stream();
    }
}
