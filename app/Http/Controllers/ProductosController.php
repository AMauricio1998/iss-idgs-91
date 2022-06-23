<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoPost;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ProductosImagen;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    public function __construct()
    {
        $this->middleware('rol.user');
    }

    public function index() {
        $productos = Producto::with('categorias', 'unidades')->paginate(5);

        return view('dashboard.productos.index', compact('productos'));
    }

    public function create() {
        $unidades = Unidad::pluck('nombre', 'id');
        $categorias = Categoria::pluck('nombre', 'id');

        return view("dashboard.productos.create", ['producto' => new Producto()], compact('unidades', 'categorias'));
    }

    public function store(StoreProductoPost $request) {

        Producto::create($request->validated([
            'activo' => 1,
            'nombre' => $request->nombre,
            'codigo_producto' => $request->codigo_producto,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'id_categoria' => $request->id_categoria,
            'id_unidad' => $request->id_unidad,
        ]));

        return back()->with('status', 'Producto registrado con exito');
    }

    public function showImage(Producto $producto) {

        $imagenes = DB::table('producto_images')
            ->select('imagen')
            ->where('id_producto', $producto->id)
            ->get();

        if (isset($imagenes)) {
            return view('dashboard.productos.show-images', compact('producto', 'imagenes'));
        }

    }

    public function show(Producto $producto) {
        $imagenes = DB::table('producto_images')
            ->select('imagen')
            ->where('id_producto', $producto->id)
            ->get();

        $img = $imagenes[0]->imagen;
        // dd($imagenes);
        return view('dashboard.productos.show', compact('producto', 'img', 'imagenes'));
    }

    public function edit(Producto $producto) {
        $unidades = Unidad::pluck('nombre', 'id');
        $categorias = Categoria::pluck('nombre', 'id');

        return view('dashboard.productos.edit', compact('unidades', 'categorias', 'producto'));
    }

    public function update(StoreProductoPost $request, Producto $producto) {

        $productos = Producto::with('categorias', 'unidades')->paginate(5);

        $producto->update($request->validated([
            'activo' => $request->activo,
            'nombre' => $request->nombre,
            'codigo_producto' => $request->codigo_producto,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'id_categoria' => $request->id_categoria,
            'id_unidad' => $request->id_unidad,
        ]));

        return back()->with('status', 'Producto actualizado con exito!');
    }

    public function imagen(Request $request, Producto $producto)
    {    
        $request->validate([
            'imagen' => 'required|mimes:jpeg,png,jpg,bmp|max:10240', //10Mb
        ]); 

        $filename = time() .".". $request->imagen->extension();

        $request->imagen->move(public_path('images'), $filename);

        ProductosImagen::create(['imagen' => $filename, 'id_producto' => $producto->id]);

        return back()->with('status', 'Imagen cargada con exito!');
    }
}
