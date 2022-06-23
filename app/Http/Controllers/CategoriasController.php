<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('rol.user');
    }

    public function index() {
        $categorias = Categoria::all();
        return view('dashboard.categorias.index', compact('categorias'));
    }
    
    public function show(Categoria $categoria) {
        return view('dashboard.categorias.show', compact('categoria'));
    }
    
    public function create() {
        return view('dashboard.categorias.create', ['categoria' => new Categoria()]);
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|unique:categorias',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'activo' => '1'
        ]);

        return redirect('/dashboard/admin/categoria-index')->with('msg-store', 'Categoria creada con exito!');
    }
    
    public function edit(Categoria $categoria) {
        return view('dashboard.categorias.edit', compact('categoria'));
    }
    
    public function update(Request $request, Categoria $categoria) {
        $request->validate([
            'nombre' => 'required',
        ]);

        $categoria->update([
            'nombre' => $request->nombre,
            'activo' => '1'
        ]);

        return back()->with('msg-update', 'Categoria actualizada con exito!');
    }
    
    public function delete() {

    }
}
