<?php

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
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('usuario-index')->get('/usuario-index', [UsusrioController::class, 'index']);
Route::name('dataForm')->get('/dataForm', [UsusrioController::class, 'dataForm']);
Route::name('select-municipios')->get('/select-municipios', [UsusrioController::class, 'selectMunicipios']);
Route::name('usuario-show')->get('/usuario-show/{user}', [UsusrioController::class, 'show']);
Route::name('usuario-create-nuevo')->post('/usuario-create', [UsusrioController::class, 'store']);
Route::name('usuario-update')->put('/usuario-update/{id}', [UsusrioController::class, 'update']);


