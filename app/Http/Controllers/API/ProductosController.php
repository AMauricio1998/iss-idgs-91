<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index() {
        $productos = Producto::with('categorias', 'unidades')->paginate(10);
        return response()->json($productos);
    }
}
