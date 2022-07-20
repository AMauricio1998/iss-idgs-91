<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use App\Http\Requests\UpdateUserPut;
use App\Models\Area;
use App\Models\Estados;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('rol.user');
    }
    
    public function index() {
        $usuarios = User::with('areas', 'roles')->paginate(5);

        return view('dashboard.usuarios.index', compact('usuarios'));
    }

    public function create() {
        $areas = Area::pluck('id', 'nombre_area');
        $roles = Rol::pluck('id', 'nombre_rol');
        $estados = Estados::pluck('nombre', 'id');

        return view("dashboard.usuarios.create", ['user' => new User()], compact('areas', 'roles', 'estados'));
    }

    public function store(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'app' => ['required', 'string', 'max:255'],
            'apm' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'max:15'],
            'colonia' => ['required', 'string', 'max:255'],
            'calle' => ['required', 'string', 'max:255'],
            'cod_postal' => ['required', 'string', 'max:5'],
            'num_calle' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'municipio' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_area' => ['required'],
            'id_rol' => ['required'],
            'status' => ['required']
        ]);

        $estado = DB::table('estados')
            ->select('nombre')
            ->where('id', $request->estado)
            ->get();
        $nuevoEdo = $estado->pluck('nombre');

        User::create([
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
        ]);

        return back()->with('status', 'Usuario registrado con exito');
        // return view('dashboard.usuarios.index', compact('usuarios'))->with('status', 'Usuario registrado con exito');
    }

    public function show(User $user) {
        return view('dashboard.usuarios.show', ['user' => $user]);
    }

    public function edit(User $user) {

        $areas = Area::pluck('id', 'nombre_area');
        $roles = Rol::pluck('id', 'nombre_rol');
        $estados = Estados::pluck('nombre', 'id');

        return view("dashboard.usuarios.edit", compact('areas', 'roles', 'estados', 'user'));
    }

    public function update(UpdateUserPut $request, User $user) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'app' => ['required', 'string', 'max:255'],
            'apm' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'max:15'],
            'colonia' => ['required', 'string', 'max:255'],
            'calle' => ['required', 'string', 'max:255'],
            'cod_postal' => ['required', 'string', 'max:5'],
            'num_calle' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'max:255'],
            'municipio' => ['required', 'string', 'max:255'],
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users'.auth()->user()->id,
            'id_area' => ['required'],
            'id_rol' => ['required'],
            'status' => ['required']
        ]);

        $estado = DB::table('estados')
            ->select('nombre')
            ->where('id', '=' , $request->estado)
            ->first();
        // $nuevoEdo = $estado->pluck('nombre');
        $nuevoEdo = $estado->nombre;

        $user->update([
            'name' => $request->name,
            'app' => $request->app,
            'apm' => $request->apm,
            'telefono' => $request->telefono,
            'colonia' => $request->colonia,
            'calle' => $request->calle,
            'cod_postal' => $request->cod_postal,
            'num_calle' => $request->num_calle,
            'estado' => $nuevoEdo,
            'municipio' => $request->municipio,
            'email' => $request->email,
            'id_area' => $request->id_area,
            'id_rol' => $request->id_rol,
            'status' => $request->status
        ]);

        return back()->with('status', 'Usuario actualizado con exito!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'Usuario eliminado con exito!');
    }

    public function proccess(User $user){

        if($user->status == '1'){
            $user->status = '2';
        }else{
            $user->status = '1';
        }
        $user->save();

        return back()->with('status', 'Status del usuario actualizado con exito!');
    }
}
