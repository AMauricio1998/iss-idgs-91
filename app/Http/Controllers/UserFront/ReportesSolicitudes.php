<?php

namespace App\Http\Controllers\UserFront;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ReportesSolicitudes extends Controller
{
    public function pdf_solicitudes($id) {
        $mytime = Carbon::now();
        $dates = $mytime->format('d-m-Y');

        $encabezados = DB::table('solicitudes')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('areas', 'users.id_area', '=', 'areas.id')
            ->select('solicitudes.created_at', 'solicitudes.id_solicitud', 'solicitudes.codigo_solicitud', 'users.name', 'users.app', 'users.apm', 'areas.nombre_area')
            ->where('solicitudes.codigo_solicitud', $id)
            ->get();

        $solicitud = DB::table('solicitudes')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('areas', 'users.id_area', '=', 'areas.id')
            ->select('solicitudes.created_at', 'solicitudes.id_solicitud', 'solicitudes.codigo_solicitud', 'users.name', 'users.app', 'users.apm','areas.nombre_area', 'productos.nombre as nombre_producto', 'detalle_solicitudes.cantidad')
            ->where('solicitudes.codigo_solicitud', $id)
            ->groupby('detalle_solicitudes.cantidad', 'solicitudes.created_at', 'solicitudes.id_solicitud', 'solicitudes.codigo_solicitud', 'users.name', 'users.app', 'users.apm', 'areas.nombre_area', 'productos.nombre')
            ->get();

        $total = DB::table('solicitudes')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->select(DB::raw('sum(detalle_solicitudes.cantidad) as Total'))
            ->where('solicitudes.codigo_solicitud', $id)
            ->first();

        $pdf = App::make('dompdf.wrapper');
        $view = View::make('users.reportes.reporte_de_solicitud', compact('encabezados', 'solicitud', 'total', 'dates'))->render();
        $pdf->loadHTML($view);
        return $pdf->stream();
    }
}
