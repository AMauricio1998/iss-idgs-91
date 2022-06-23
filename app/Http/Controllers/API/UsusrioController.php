<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPost;
use App\Http\Requests\UpdateUserPut;
use App\Models\Area;
use App\Models\Estados;
use App\Models\Municipio;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UsusrioController extends Controller
{
    public function index() {
        $usuarios = User::with('areas', 'roles')->paginate(20);
        
        return response()->json($usuarios);
    }

    public function dataForm() {
        $areas = Area::all();
        $roles = Rol::all();
        $estados = Estados::all();

        return response()->json([
            'areas' => $areas,
            'roles' => $roles,
            'estados' => $estados,
        ]);
    }

    public function selectMunicipios() {
        $municipios = Municipio::all();

        return response()->json($municipios);
    }

    public function show($id) {
        try {
            $usu = User::with('roles', 'areas')->find($id);
            return response()->json($usu);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(StoreUserPost $request) {
        try {
            $estado = DB::table('estados')
                ->select('nombre')
                ->where('id', $request->estado)
                ->get();
            $nuevoEdo = $estado->pluck('nombre');

            $usuarioAlmacenado = User::create($request->validated([
                'name' => $request->name,
                'app' => $request->app,
                'apm' => $request->apm,
                'telefono' => $request->telefono,
                'colonia' => $request->colonia,
                'calle' => $request->calle,
                'cod_postal' => $request->cod_postal,
                'num_calle' => $request->num_calle,
                'estado' => $nuevoEdo[0],
                'municipio' => $request->municipio,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_area' => $request->id_area,
                'id_rol' => $request->id_rol,
                'status' => $request->status
            ]));

            return response()->json($usuarioAlmacenado);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(UpdateUserPut $request, $id) {
        try {
            $estado = DB::table('estados')
            ->select('nombre')
            ->where('id', $request->estado)
            ->get();
            $nuevoEdo = $estado->pluck('nombre');

            $usuario = User::findOrFail($id);

            $usuario->update($request->validated([
                'name' => $request->name,
                'app' => $request->app,
                'apm' => $request->apm,
                'telefono' => $request->telefono,
                'colonia' => $request->colonia,
                'calle' => $request->calle,
                'cod_postal' => $request->cod_postal,
                'num_calle' => $request->num_calle,
                'estado' => $nuevoEdo[0],
                'municipio' => $request->municipio,
                'email' => $request->email,
                'id_area' => $request->id_area,
                'id_rol' => $request->id_rol,
                'status' => $request->status
            ]));

            return response()->json($usuario);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], $e->getMessage());
        }
    }
}
