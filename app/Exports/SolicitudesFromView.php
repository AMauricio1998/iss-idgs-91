<?php

namespace App\Exports;

use App\Models\Solicitud;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SolicitudesFromView implements FromView {
    public function view(): View {
        $solicitudes = DB::table('solicitudes')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('areas', 'users.id_area', '=', 'areas.id')
            ->join('status', 'solicitudes.id_status', '=', 'status.id')
            ->select(
                'solicitudes.id_solicitud',
                'solicitudes.codigo_solicitud',
                'status.nombre_status',
                'users.name',
                'users.app',
                'users.apm',
                'areas.nombre_area',
                'productos.nombre as nombre_producto',
                'detalle_solicitudes.cantidad',
                'solicitudes.created_at',
            )->get();

        return view('dashboard.excel.solicitudes-excel', [
            'solicitudes' => $solicitudes
        ]);
    }
}
