<?php

namespace App\Http\Controllers;

use App\Exports\SolicitudesFromView;
use App\Exports\UsuariosFromView;
use App\Models\DetalleSolicitud;
use App\Models\Solicitud;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class ReportesAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('rol.user');
    }
    
    public function generar()
    {
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

    //------------ PDF solicitud en especifico -----------------------
    public function solicitud_PDF(Request $request, $id)
    {
        $mytime = Carbon::now();
        $dates = $mytime->format('d-m-Y');

        $encabezados = DB::table('solicitudes')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('areas', 'users.id_area', '=', 'areas.id')
            ->select(
                'solicitudes.created_at', 
                'solicitudes.id_solicitud', 
                'solicitudes.codigo_solicitud', 
                'users.name', 
                'users.app', 
                'users.apm', 
                'users.email',
                'areas.nombre_area')
            ->where('solicitudes.codigo_solicitud', $id)
            ->get();
        
        $solicitud = DB::table('solicitudes')
            ->join('detalle_solicitudes', 'solicitudes.codigo_solicitud', '=', 'detalle_solicitudes.codigo_solicitud')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->join('users', 'solicitudes.id_usuario', '=', 'users.id')
            ->join('areas', 'users.id_area', '=', 'areas.id')
            ->select(
                'solicitudes.created_at',
                'solicitudes.id_solicitud',
                'solicitudes.codigo_solicitud',
                'users.name',
                'users.app',
                'users.apm',
                'areas.nombre_area',
                'productos.nombre as nombre_producto',
                'detalle_solicitudes.cantidad'
            )
            ->where('solicitudes.codigo_solicitud', $id)
            ->groupby(
                'detalle_solicitudes.cantidad',
                'solicitudes.created_at',
                'solicitudes.id_solicitud',
                'solicitudes.codigo_solicitud',
                'users.name',
                'users.app',
                'users.apm',
                'areas.nombre_area',
                'productos.nombre'
            )->get();

        $total = DetalleSolicitud::where('codigo_solicitud', $id)->sum('cantidad');

        $pdf = App::make('dompdf.wrapper');
        $view = View::make('dashboard.solicitudes.reporte_de_solicitud', compact('encabezados', 'solicitud', 'total', 'dates'))->render();
        $pdf->loadHTML($view);
        return $pdf->stream();

    }

    public function usuariosExcel() {
        return Excel::download(new UsuariosFromView, 'usuarios.xlsx');
    }

    public function solicitudesExcel() {
        return Excel::download(new SolicitudesFromView, 'solicitudes.xlsx');
    }
}
