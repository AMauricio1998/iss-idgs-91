<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Estados;
use App\Models\Municipio;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $areas = Area::pluck('id', 'nombre_area');
        $estados = Estados::pluck('nombre', 'id');
        return view('auth.register', compact('areas', 'estados'));
    }

    public function selectMunicipios() {
        $municipios = Municipio::all();

        return response()->json($municipios);
    }
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
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
            'g-recaptcha-response' => 'recaptcha'
        ]);

        $estado = DB::table('estados')
            ->select('nombre')
            ->where('id', $request->estado)
            ->get();
        $nuevoEdo = $estado->pluck('nombre');

        $user = User::create([
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
            'id_rol' => '2',
            'status' => '1'
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
