<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GraficasController;
use App\Http\Controllers\API\SolicitudesController;
use App\Http\Controllers\API\UsusrioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| Encryption keys generated successfully.
| Personal access client created successfully.
| Client ID: 1
| Client secret: 5Qge35Y8O3dqFegOK6nyL7OuZt65DWl1du9STAAb
| Password grant client created successfully.
| Client ID: 2
| Client secret: MkYCN71VCvgyPEscjJjGm386jMUNDYlcczRQ1kwh
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::name('login')->post('/login', [AuthController::class, 'login']);
Route::name('logout')->post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::name('user')->get('/user-auth', [AuthController::class, 'user'])->middleware('auth:api');

Route::group(['middleware' => ['auth:api']], function () {
    Route::name('estadisticas')->get('/estadisticas', [GraficasController::class, 'grafica']);
    Route::name('graficas')->get('/graficas', [GraficasController::class, 'graficas']);

    // Usuarios
    Route::name('usuario-index')->get('/usuario-index', [UsusrioController::class, 'index']);
    Route::name('usuario-show')->get('/usuario-show/{user}', [UsusrioController::class, 'show']);
    Route::name('usuario-create-nuevo')->post('/usuario-create', [UsusrioController::class, 'store']);
    Route::name('usuario-update')->put('/usuario-update/{id}', [UsusrioController::class, 'update']);
    Route::name('select-municipios')->get('/select-municipios', [UsusrioController::class, 'selectMunicipios']);
    Route::name('dataForm')->get('/dataForm', [UsusrioController::class, 'dataForm']);
    Route::name('usuario-destroy')->delete('/usuario-destroy/{user}', [UsusrioController::class, 'destroy']);
    Route::name('usuario-proccess')->post('/usuario-proccess/{user}', [UsusrioController::class, 'proccess']);

    // Solicitudes
    Route::name('solicitudes-index')->get('/solicitudes-index', [SolicitudesController::class, 'solicitudesIndex']);
});
