<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('index');
});

// Productos
Route::resource('products', ProductController::class);





// Ventas
Route::get('/ventas/nueva-venta', function () {
    return view('ventas.nueva-venta');
});

Route::get('/ventas/listado-ventas', function () {
    return view('ventas.listado-ventas');
});

// Pedidos
Route::get('/pedidos/agregar-pedido', function () {
    return view('pedidos.agregar-pedido');
});

Route::get('/pedidos/listado-pedidos', function () {
    return view('pedidos.listado-pedidos');
});

// Proveedores
Route::get('/proveedores/nuevo-proveedor', function () {
    return view('proveedores.nuevo-proveedor');
});

Route::get('/proveedores/listado-proveedores', function () {
    return view('proveedores.listado-proveedores');
});

// Usuarios
Route::get('/usuarios/nuevo-usuario', function () {
    return view('usuarios.nuevo-usuario');
});

Route::get('/usuarios/listado-usuarios', function () {
    return view('usuarios.listado-usuarios');
});