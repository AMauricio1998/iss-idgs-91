<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    public function graficas(){

        $solicitudes = DB::table('detalle_solicitudes')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->select('detalle_solicitudes.id_producto', 'productos.nombre')
            ->selectRaw('count(detalle_solicitudes.id_producto) as num_pedidos')
            ->groupby('detalle_solicitudes.id_producto', 'productos.nombre')
            ->orderBy(DB::raw('count(*)'))
            ->take(3)
            ->get();

            $solicitudes = json_decode($solicitudes);
            return $solicitudes;

            $solicitudes_usuario = DB::table('detalle_solicitudes')
            ->join('productos', 'detalle_solicitudes.id_producto', '=', 'productos.id')
            ->select('detalle_solicitudes.id_producto', 'productos.nombre')
            ->selectRaw('count(detalle_solicitudes.id_producto) as num_pedidos')
            ->where('solicitudes.id_usuario', auth()->user()->id)
            ->groupby('detalle_solicitudes.id_producto', 'productos.nombre')
            ->orderBy(DB::raw('count(*)'))
            ->take(3)
            
            ->get();

            $soli_usuarios = json_decode($solicitudes_usuario);
            return $solicitudes;
    }
    public function grafica(){
        $usuarios = DB::table('users')
            ->select(DB::raw('count(*) as cantidad'))
            ->get();
        // ------------------- Usuarios activos e inactivos ----
        $ususActivos = DB::table('users')
            ->select(DB::raw('count(*) as cantidad'))
            ->where('status', '=', 1)
            ->get();

        $ususInactivos = DB::table('users')
            ->select(DB::raw('count(*) as cantidad'))
            ->where('status', '=', 2)
            ->get();

        // ------------------------------------------------------

        $soliCreadas = DB::table('solicitudes')
            ->select(DB::raw('count(*) as cantidad'))
            ->where('id_status', '=', 1)
            ->get();

        $soliPendientes = DB::table('solicitudes')
            ->select(DB::raw('count(*) as cantidad'))
            ->where('id_status', '=', 2)
            ->get();

        $soliCompletadas = DB::table('solicitudes')
            ->select(DB::raw('count(*) as cantidad'))
            ->where('id_status', '=', 3)
            ->get();


            //  $pendientes = DB::table('solicitudes')
            //  ->select(DB::raw('count(*) as cantidad'))
            //  ->where('solicitudes.idusuario',session('session_id'))
            //  ->where('idestatus', '=', 2)
            //  ->get();
             
            //  $completa = DB::table('solicitudes')
            //  ->select(DB::raw('count(*) as cantidad'))
            //  ->where('solicitudes.idusuario',session('session_id'))
            //  ->where('idestatus', '=', 3)
            //  ->get();

            //  $terminarse = DB::table('productos')
            //  ->select('nombre_producto','cantidad')
            //  ->where('cantidad','<',5)
            //  ->get();

        return view('dashboard')->with(compact('usuarios', 'ususActivos', 'ususInactivos', 'soliCreadas', 'soliPendientes', 'soliCompletadas'));
    }    
}
