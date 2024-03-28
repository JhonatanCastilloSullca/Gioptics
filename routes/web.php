<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MedioController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\SaldocController;
use App\Http\Controllers\GraphicsController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\AdicionalController;
use App\Http\Controllers\CaracteristicaController;
use App\Http\Controllers\CategoriaCompraController;








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

Route::group(['middleware'=>['guest']], function () {
    Route::get('/','App\Http\Controllers\Auth\LoginController@showLoginForm');
    Route::post('/', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
});


Route::group(['middleware'=>['auth']], function () {

    Route::get('/home', [App\Http\Controllers\GraphicsController::class, 'index'])->name('home');    
    Route::get('/graphics',[App\Http\Controllers\GraphicsController::class, 'index']);


    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::resource('user', UserController::class );
    Route::resource('proveedor', ProveedorController::class );
    Route::resource('paciente', PacienteController::class );
    Route::resource('cliente', ClienteController::class );
    Route::resource('categoria', CategoriaController::class );
    Route::resource('sucursal', SucursalController::class );
    Route::resource('producto', ProductoController::class );
    Route::resource('medio', MedioController::class );
    Route::resource('caja', CajaController::class );
    Route::resource('venta', VentaController::class );
    Route::resource('medida', MedidaController::class );
    Route::resource('compra', CompraController::class );
    Route::resource('detalleventa', DetalleVentaController::class );
    Route::resource('detallecompra', DetalleCompraController::class );
    Route::resource('saldo', SaldoController::class );
    Route::resource('unidad', UnidadController::class );    
    Route::resource('saldoc', SaldocController::class );
    Route::resource('buscar', BuscarController::class );
    Route::resource('adicional', AdicionalController::class );
    Route::resource('caracteristica', CaracteristicaController::class );
    Route::resource('categoriacompra', CategoriaCompraController::class );
    Route::get('/entregados', 'App\Http\Controllers\SaldoController@entregados')->name('entregados');
    Route::get('/usersrealtime', [App\Http\Controllers\UserController::class, 'prueba'])->name('usersrealtime');
    Route::get('/categoriarealtime', [App\Http\Controllers\CategoriaController::class, 'prueba'])->name('categoriarealtime');
    Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'prueba'])->name('productos');
    Route::get('/productosinve', [App\Http\Controllers\ProductoController::class, 'prueba2'])->name('productosinve');
    Route::get('/crearmedicion/{id}','App\Http\Controllers\MedidaController@edit');
    Route::get('/medidasrealizadas','App\Http\Controllers\MedidaController@medidasrealizadas')->name('medidasrealizadas');
    Route::get('/medidasrealtime','App\Http\Controllers\MedidaController@prueba')->name('medidasrealtime');
    Route::get('/medidasventa','App\Http\Controllers\MedidaController@prueba2')->name('medidasventa');
    Route::get('medida/recetapdf/{id}','App\Http\Controllers\MedidaController@recetapdf');
    Route::get('/ventapdf/{id}','App\Http\Controllers\VentaController@ventapdf');
    Route::get('/cajadiaria','App\Http\Controllers\CajaController@cajadiaria');
    Route::get('/ingreso','App\Http\Controllers\ReporteController@ingreso');
    Route::get('ingresopdf/{sql2}/{sql4}/{sql5}/{sql6}','App\Http\Controllers\ReporteController@ingresopdf');
    Route::get('/ingresoexcel/{sql2}/{sql4}/{sql5}/{sql6}', 'App\Http\Controllers\ReporteController@ingresoexcel');
    Route::get('/compras','App\Http\Controllers\ReporteController@compras');
    Route::get('compraspdf/{sql2}/{sql4}/{sql5}/{sql6}','App\Http\Controllers\ReporteController@compraspdf');
    Route::get('/comprasexcel/{sql2}/{sql4}/{sql5}/{sql6}', 'App\Http\Controllers\ReporteController@comprasexcel');
    Route::get('/ventas','App\Http\Controllers\ReporteController@ventas');
    Route::get('ventaspdf/{sql2}/{sql4}/{sql5}/{sql6}/{sql7}','App\Http\Controllers\ReporteController@ventaspdf');
    Route::get('/ventasexcel/{sql2}/{sql4}/{sql5}/{sql6}/{sql7}', 'App\Http\Controllers\ReporteController@ventasexcel');
    Route::get('/historia','App\Http\Controllers\ReporteController@historia');
    Route::get('/productosreporte','App\Http\Controllers\ReporteController@productos');
    Route::get('historiapdf/{sql2}/{sql4}/{sql5}/{sql6}/{sql7}','App\Http\Controllers\ReporteController@historiapdf');
    Route::get('/historiaexcel/{sql2}/{sql4}/{sql5}/{sql6}/{sql7}', 'App\Http\Controllers\ReporteController@historiaexcel');
    Route::get('/cajas','App\Http\Controllers\ReporteController@cajas');
    Route::get('cajaspdf/{sql2}/{sql4}/{sql5}/{sql6}/{sql7}','App\Http\Controllers\ReporteController@cajaspdf');
    Route::get('/cajasexcel/{sql2}/{sql4}/{sql5}/{sql6}/{sql7}', 'App\Http\Controllers\ReporteController@cajasexcel');
    Route::get('productospdf/{sql}/{sql2}/{sql3}/{sql4}','App\Http\Controllers\ReporteController@productospdf');
    Route::get('/productosexcel/{sql}/{sql2}/{sql3}/{sql4}', 'App\Http\Controllers\ReporteController@productosexcel');
    Route::get('deletemedida/{id}','App\Http\Controllers\MedidaController@delete');
    Route::get('autocomplete','App\Http\Controllers\MedidaController@autocomplete')->name('autocomplete');
    Route::get('medida/medidaeliminar/{id}','App\Http\Controllers\MedidaController@delete');
    Route::get('deleteusuario/{id}','App\Http\Controllers\UserController@delete');
    Route::get('deletemedio/{id}','App\Http\Controllers\MedioController@delete');
    Route::get('categoriacrud','App\Http\Controllers\CategoriaController@categoriacrud');
    Route::get('deletecategoria/{id}','App\Http\Controllers\CategoriaController@delete');
    Route::get('deleteunidad/{id}','App\Http\Controllers\UnidadController@delete');
    Route::get('deletecaracteristica/{id}','App\Http\Controllers\CaracteristicaController@delete');
    Route::get('deleteadicional/{id}','App\Http\Controllers\AdicionalController@delete');
    Route::get('deletesucursal/{id}','App\Http\Controllers\SucursalController@delete');
    Route::get('deletepaciente/{id}','App\Http\Controllers\PacienteController@delete');
    Route::get('deletecliente/{id}','App\Http\Controllers\ClienteController@delete');
    Route::get('medida/editar/{id}','App\Http\Controllers\MedidaController@editar');
    Route::patch('medida/guardareditar/{id}','App\Http\Controllers\MedidaController@guardareditar')->name('guardareditar');
});

