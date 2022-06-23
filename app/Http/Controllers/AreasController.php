<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Producto;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function __construct()
    {
        $this->middleware('rol.user');
    }
    
    public function index() {
        $areas = Area::all();
        return view('dashboard.areas.index', compact('areas'));
    }
    
    public function show(Area $area) {
        return view('dashboard.areas.show', compact('area'));
    }
    
    public function create() {
        return view('dashboard.areas.create', ['area' => new Area()]);
    }

    public function store(Request $request) {
        $request->validate([
            'nombre_area' => 'required|unique:areas',
            'clave' => 'required|unique:areas',
            'descripcion' => 'required'
        ]);

        Area::create([
            'nombre_area' => $request->nombre_area,
            'clave' => $request->clave,
            'descripcion' => $request->descripcion
        ]);

        return redirect('/dashboard/admin/area-index')->with('msg-store', 'Area creada con exito!');
    }
    
    public function edit(Area $area) {
        return view('dashboard.areas.edit', compact('area'));
    }
    
    public function update(Request $request, Area $area) {
        $request->validate([
            'nombre_area' => 'required',
            'clave' => 'required',
            'descripcion' => 'required'
        ]);

        $area->update([
            'nombre_area' => $request->nombre_area,
            'clave' => $request->clave,
            'descripcion' => $request->descripcion
        ]);

        return back()->with('msg-update', 'Area actualizada con exito!');
    }
    
    public function delete() {

    }
}
