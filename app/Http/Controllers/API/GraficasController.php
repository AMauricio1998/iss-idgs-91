<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        
        return response()->json($solicitudes);
    }

    public function grafica() {
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

        return response()->json([
            'usuarios' => $usuarios,
            'usuarios_activos' => $ususActivos,
            'usuarios_inactivos' => $ususInactivos,
            'solicitudes_creadas' => $soliCreadas,
            'solicitudes_pendientes' => $soliPendientes,
            'solicitudes_completadas' => $soliCompletadas
        ]);
    }
}
