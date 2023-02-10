<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Models\Tipo_Producto;

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
   return redirect()->to(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/perfil', [App\Http\Controllers\HomeController::class, 'perfil'])->name('perfil');

Route::controller(UsuarioController::class)->group(function (){
    Route::get('usuario','index')->name('usuario.index');
    Route::post('usuario/update_perfil','update_perfil')->name('usuario.update_perfil');
    Route::post('usuario/update_password','update_password')->name('usuario.update_password');
    Route::get('usuario/DatosServerSideActivo','DatosServerSideActivo')->name('usuario.DatosServerSideActivo'); //activos
    Route::get('usuario/DatosServerSideInactivo','DatosServerSideInactivo')->name('usuario.DatosServerSideInactivo'); //eliminados
    Route::get('usuario/perfil','perfil')->name('usuario.perfil');
    Route::post('usuario/store','store')->name('usuario.store');
    Route::post('usuario/update/{id}','update')->name('usuario.update');
    Route::get('usuario/destroy/{id}','destroy')->name('usuario.destroy');
    Route::get('usuario/restore/{id}','restore')->name('usuario.restore');
    Route::get('usuario/buscar/{id}','buscarPoUsuario')->name('usuario.buscar');
});

Route::controller(RoleController::class)->group(function (){
    Route::get('rol','index')->name('rol.index');
    Route::get('rol/DatosServerSideActivo','DatosServerSideActivo')->name('rol.DatosServerSideActivo'); //activos
    Route::get('rol/DatosServerSideInactivo','DatosServerSideInactivo')->name('rol.DatosServerSideInactivo'); //eliminados
    Route::post('rol/store','store')->name('rol.store');
    Route::post('rol/update/{id}','update')->name('rol.update');
    Route::get('rol/destroy/{id}','destroy')->name('rol.destroy');
    Route::get('rol/restore/{id}','restore')->name('rol.restore');
    Route::get('rol/buscar/{id}','buscarPorRol')->name('rol.buscar');
    Route::get('rol/permisos/{id}','permiso_rol')->name('rol.permisos');
    Route::post('rol/update_permiso/{id}','update_permisos')->name('rol.update_permiso');
});

Route::controller(ReporteController::class)->group(function (){
    Route::get('reporte','index')->name('reporte.index');
    Route::post('reporte/usuario','pdf_usuario')->name('reporte.usuario');
    Route::post('reporte/rol','pdf_rol')->name('reporte.rol');
    Route::post('reporte/caja','prueba')->name('reporte.caja');
    Route::post('reporte/egreso','prueba2')->name('reporte.egreso');
    Route::get('retorte/gestion/{id}/{sw}','reporte_pdf')->name('reporte.gestion');  
 
});

Route::controller(GestionController::class)->group(function (){
    Route::get('gestion','index')->name('gestion.index');
    Route::get('gestion/DatosServerSideActivo','DatosServerSideActivo')->name('gestion.DatosServerSideActivo'); //activos
    Route::get('gestion/DatosServerSideInactivo','DatosServerSideInactivo')->name('gestion.DatosServerSideInactivo'); //eliminados
    Route::post('gestion/store','store')->name('gestion.store');
    Route::post('gestion/update/{id}','update')->name('gestion.update');
    Route::get('gestion/buscar/{id}','buscarPorGestion')->name('gestion.buscar');
    Route::get('gestion/destroy/{id}','destroy')->name('gestion.destroy');
    Route::get('gestion/restore/{id}','restore')->name('gestion.restore');  
    Route::get('gestion/extra','extra')->name('gestion.extra');
    Route::get('gestion/gestion_global_update/{id_gestion}','gestion_global_update')->name('gestion.gestion_global_update');
    Route::get('gestion/gestion_global_caja','gestion_global_caja')->name('gestion.gestion_global_caja');
    // gastos de gestion con caja
    Route::get('gestion/gasto/{id}/{sw}','gastos_gestion')->name('gestion.gasto');  
    Route::get('gestion/tipo','buscarTipos')->name('gestion.tipo');
});

Route::controller(CajaController::class)->group(function (){
    Route::get('caja','index')->name('caja.index');
    Route::get('caja/DatosServerSideActivo','DatosServerSideActivo')->name('caja.DatosServerSideActivo'); //activos
    Route::get('caja/DatosServerSideInactivo','DatosServerSideInactivo')->name('caja.DatosServerSideInactivo'); //eliminados
   Route::post('caja/store','store')->name('caja.store');
   Route::post('caja/update/{id}','update')->name('caja.update');
    Route::get('caja/destroy/{id}','destroy')->name('caja.destroy');
    Route::get('caja/restore/{id}','restore')->name('caja.restore');  
    Route::get('caja/buscar/{id}','buscarPorCaja')->name('caja.buscar');
   
    // socio tabla intermedia
    Route::get('caja/socio/{id}','socio')->name('socio');  
    Route::get('caja/socio/DatosServerSideActivo/{id}','socio_DatosServerSideActivo')->name('caja.socio.DatosServerSideActivo'); //activos
    Route::get('caja/socio/buscar/{valor}','buscarPorUsuario')->name('caja.socio.buscar');
    Route::post('caja/socio/add','socio_add')->name('caja.socio.add');  
    Route::post('caja/socio/destroy','socio_destroy')->name('caja.socio.destroy'); 
    // egreso y ingreso de la caja 
    Route::post('caja/egreso/add','egreso_add')->name('caja.egreso.add');
    Route::post('caja/ingreso/add','ingreso_add')->name('caja.ingreso.add');
    Route::get('caja/monto/{id}','caja_monto')->name('caja.monto');  
    Route::get('caja/ingreso/DatosServerSide/{id}','Data_Ingresos')->name('caja.ingreso.DatosServerSide'); //activos
    Route::get('caja/egreso/DatosServerSide/{id}','Data_Egresos')->name('caja.egreso.DatosServerSide'); //activos
    Route::get('caja/ingreso/destroy/{id}','ingreso_destroy')->name('caja.ingreso.destroy');
    Route::get('caja/egreso/destroy/{id}','egreso_destroy')->name('caja.egreso.destroy');
});

Route::controller(EmpleadoController::class)->group(function (){
    Route::get('empleado','index')->name('empleado.index');
    Route::get('empleado/destroy/{id}','destroy')->name('empleado.destroy');
    Route::get('empleado/restore/{id}','restore')->name('empleado.restore');
    Route::get('empleado/DatosServerSideActivo','DatosServerSideActivo')->name('empleado.DatosServerSideActivo'); //activos
    Route::get('empleado/DatosServerSideInactivo','DatosServerSideInactivo')->name('empleado.DatosServerSideInactivo'); //eliminados
    Route::get('empleado/buscar/{id}','buscarPorEmpleado')->name('empleado.buscar');
    Route::post('empleado/store','store')->name('empleado.store');
    Route::post('empleado/update/{id}','update')->name('empleado.update');  
});

Route::controller(ProveedorController::class)->group(function (){
    Route::get('proveedor','index')->name('proveedor.index');
    Route::get('proveedor/destroy/{proveedor}','destroy')->name('proveedor.destroy');
    Route::get('proveedor/restore/{proveedor}','restore')->name('proveedor.restore');
    Route::get('proveedor/DatosServerSideActivo','DatosServerSideActivo')->name('proveedor.DatosServerSideActivo'); //activos
    Route::get('proveedor/DatosServerSideInactivo','DatosServerSideInactivo')->name('proveedor.DatosServerSideInactivo'); //eliminados
    Route::get('proveedor/buscar/{id}','buscar')->name('proveedor.buscar');
   Route::post('proveedor/store','store')->name('proveedor.store');
   Route::post('proveedor/update/{proveedor}','update')->name('proveedor.update');  
});
Route::controller(ProductoController::class)->group(function (){
    Route::get('producto','index')->name('producto.index');
    Route::get('producto/destroy/{producto}','destroy')->name('producto.destroy');
    Route::get('producto/restore/{producto}','restore')->name('producto.restore');
    Route::get('producto/DatosServerSideActivo','DatosServerSideActivo')->name('producto.DatosServerSideActivo'); //activos
    Route::get('producto/DatosServerSideInactivo','DatosServerSideInactivo')->name('producto.DatosServerSideInactivo'); //eliminados
    Route::get('producto/buscar/{producto}','buscar')->name('producto.buscar');
    Route::get('producto/extra','extra')->name('producto.extra');
    Route::get('producto/catalogo','catalogo')->name('producto.catalogo');
   Route::post('producto/store','store')->name('producto.store');
   Route::post('producto/update/{producto}','update')->name('producto.update');

});

Route::controller(EgresoController::class)->group(function (){
    Route::get('egreso','index')->name('egreso.index');
    Route::get('egreso/DatosServerSideActivo','DatosServerSideActivo')->name('egreso.DatosServerSideActivo'); //activos
    Route::get('egreso/empleado/buscar/{id}','buscarPorEmpleado')->name('egreso.empleado.buscar');
    Route::get('egreso/marcar/{id}','marcar')->name('egreso.marcar');
});

Route::controller(IngresoController::class)->group(function (){
    Route::get('ingreso','index')->name('ingreso.index');
    Route::get('ingreso/DatosServerSideActivo','DatosServerSideActivo')->name('ingreso.DatosServerSideActivo'); //activos
    Route::get('ingreso/empleado/buscar/{id}','buscarPorEmpleado')->name('ingreso.empleado.buscar');
    Route::get('ingreso/marcar/{id}','marcar')->name('ingreso.marcar');
});


// ejemplos admin lte

Route::get(
    'notifications/get',
    [App\Http\Controllers\NotificationsController::class, 'getNotificationsData']
)->name('notifications.get');

Route::match(
    ['get', 'post'],
    '/navbar/search',
    'SearchController@showNavbarSearchResults'
);
