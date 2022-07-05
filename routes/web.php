<?php

use App\Exports\UsuariosFromView;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ReportesAdminController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\UserFront\CarritoController;
use App\Http\Controllers\UserFront\ReportesSolicitudes;
use App\Http\Controllers\UserFront\SolicitudesController as UserFrontSolicitudesController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth'])->name('dashboard');

Route::name('select-municipios')->get('/select-municipios', [RegisteredUserController::class, 'selectMunicipios']);

//Administrador
Route::group(['prefix' => 'dashboard/admin', 'middleware' => ['auth']], function() {
    //  ----- Graficas --------------
    Route::name('dashboard')->get('/dashboard', [GraficasController::class, 'grafica']);
    Route::name('graficas')->get('/graficas', [GraficasController::class, 'graficas']);

    // ----------- Areas -----------------------------
    Route::name('area-index')->get('/area-index', [AreasController::class, 'index']);
    Route::name('area-create')->get('/area-show', [AreasController::class, 'create']);
    Route::name('area-show')->get('/area-show/{area}', [AreasController::class, 'show']);
    Route::name('area-edit')->get('/area-edit/{area}', [AreasController::class, 'edit']);
    Route::name('area-create-nueva')->post('/area-create', [AreasController::class, 'store']);
    Route::name('area-update')->put('/area-update/{area}', [AreasController::class, 'update']);
    
    // ----------- Caregorias -----------------------------
    Route::name('categoria-index')->get('/categoria-index', [CategoriasController::class, 'index']);
    Route::name('categoria-create')->get('/categoria-show', [CategoriasController::class, 'create']);
    Route::name('categoria-show')->get('/categoria-show/{categoria}', [CategoriasController::class, 'show']);
    Route::name('categoria-edit')->get('/categoria-edit/{categoria}', [CategoriasController::class, 'edit']);
    Route::name('categoria-create-nueva')->post('/categoria-create', [CategoriasController::class, 'store']);
    Route::name('categoria-update')->put('/categoria-update/{categoria}', [CategoriasController::class, 'update']);

    // ----------- Usuarios -------------------------
    Route::name('usuario-index')->get('/usuario-index', [UsuarioController::class, 'index']);
    Route::name('usuario-create')->get('/usuario-create', [UsuarioController::class, 'create']);
    Route::name('usuario-create-nuevo')->post('/usuario-create', [UsuarioController::class, 'store']);
    Route::name('usuario-show')->get('/usuario-show/{user}', [UsuarioController::class, 'show']);
    Route::name('usuario-edit')->get('/usuario-edit/{user}', [UsuarioController::class, 'edit']);
    Route::name('usuario-update')->put('/usuario-update/{user}', [UsuarioController::class, 'update']);
    Route::name('usuario-destroy')->delete('/usuario-destroy/{user}', [UsuarioController::class, 'destroy']);
    Route::name('usuario-proccess')->post('/usuario-proccess/{user}', [UsuarioController::class, 'proccess']);

    //------------- Productos -----------------------
    Route::name('productos-index')->get('/productos-index', [ProductosController::class, 'index']);
    Route::name('productos-create')->get('/productos-create', [ProductosController::class, 'create']);
    Route::name('productos-create')->post('/productos-create', [ProductosController::class, 'store']);
    Route::name('productos-show')->get('/productos-show/{producto}', [ProductosController::class, 'show']);
    Route::name('productos-showImage')->get('/productos-showImage/{producto}', [ProductosController::class, 'showImage']);
    Route::name('productos-edit')->get('/productos-edit/{producto}', [ProductosController::class, 'edit']);
    Route::name('productos-update')->put('/productos-update/{producto}', [ProductosController::class, 'update']);
    Route::name('productos-imagen')->post('/productos-imagen/{producto}', [ProductosController::class, 'imagen']);

    //---------------- Solicitudes ---------------------
    Route::name('solicitudes-index')->get('/solicitudes-index', [SolicitudesController::class, 'solicitudesIndex']);
    Route::name('detalle-solicitud')->get('/detalle-solicitud/{id?}',[SolicitudesController::class, 'detalle_solicitud']);
    Route::name('modificar-solicitud')->put('modificar-solicitud/{id?}', [SolicitudesController::class, 'modificarSolicitud']); //Modifica el estado de la solicitud
    //--------------- Generar PDF ------------------------
    Route::name('solicitudes-PDF')->get('/solicitudes-PDF', [ReportesAdminController::class, 'generar']); //PDF todas las solicitudes
    Route::name('solicitud-PDF')->get('solicitud-PDF/{id?}',[ReportesAdminController::class, 'solicitud_PDF']); //Solicitud en especifico con su detalle

    // -- excel ----
    Route::name('excel-usuarios')->get('/excel-usuarios', [ReportesAdminController::class, 'usuariosExcel']); 
    Route::name('excel-solicitudes')->get('/excel-solicitudes', [ReportesAdminController::class, 'solicitudesExcel']); 
});

Route::group(['prefix' => 'dashboard/user', 'middleware' => ['auth', 'rol.admin']], function() {
    Route::name('solicitudes-index-user')->get('/solicitudes', [UserFrontSolicitudesController::class, 'solicitudes']);
    Route::name('nueva-solicitud')->get('/nueva-solicitud', [CarritoController::class, 'nueva_solicitud']);

    // --------- Carrito ------------------------------
    Route::name('add-producto')->get('/add/{id?}', [CarritoController::class, 'add']);
    Route::name('informacion-cart')->get('/informacion-cart', [CarritoController::class, 'informacion_cart']);
    Route::name('eliminar-carrito')->get('/eliminar_carrito',[CarritoController::class, 'eliminar_carrito']);
    Route::name('actualizar-cart')->get('/actualizar-cart/{id?}',[CarritoController::class, 'actualizar']);
    Route::name('destruir-item')->get('/destruir-item/{id?}', [CarritoController::class, 'destruir']);
    Route::name('store-item')->get('store-item', [CarritoController::class, 'store']);
    
    // ------------ Editar solicitud ---------------------------
    Route::name('editar_solicitud')->get('editar-solicitud/{codigo?}',[CarritoController::class, 'editar_solicitud']);
    Route::name('productos_editar')->get('productos_editar/{codigo?}',[CarritoController::class, 'productos_editar']);
    Route::name('mostrar-carrito')->get('mostrar-carrito/{codigo?}', [CarritoController::class, 'mostrar_carrito']);
    Route::name('editar-solicitud')->get('editar_solicitud/{codigo?}', [CarritoController::class, 'solicitudUpdate']);    

    //Eliminar productos de una soliitud creada 
    Route::name('eliminar_producto')->get('eliminar_producto/{id?}/{codigo}', [CarritoController::class, 'eliminar_producto']);

    // ----------Reporte de solicitudes email -------------
    Route::name('reporte_solicitud')->get('reporte_solicitud/{id?}', [UserFrontSolicitudesController::class, 'reporte_solicitud']);

    // ----------Reporte PDF de las solicitudes ---------------
    Route::name('pdf_solicitudes')->get('pdf_solicitudes/{id?}', [ReportesSolicitudes::class, 'pdf_solicitudes']);

    //------- PAYPAL ------
    Route::name('paypal.process')->get('paypal/process/{orderId?}', [PaymentController::class, 'process']);
});


require __DIR__.'/auth.php';
