<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
        ]);

        //-- Verificar credenciales --
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'msg' => 'Credenciales incorrectas', 401
            ]);
        }

        $user = $request->user();
        $tokenAuth = $user->createToken('Personal Access Tokens');
        // $token = $tokenAuth->token;

        $user = User::with('roles', 'areas')->find(Auth::user()->id);

        return response()->json([
            'user' => $user,
            'access_token' => $tokenAuth->accessToken,
            'Authorization' => 'Bearer ',
            'expires_at'   => Carbon::parse(
                $tokenAuth->token->expires_at)
                ->toDateTimeString(),
        ]);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['msg' => 'Se ha cerrado la sesión con éxito']);
    }

    public function user(Request $request) {
        return response()->json([
            'user' => $request->user()
        ]);
    }
}
