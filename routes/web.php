<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SaleController;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Sale;
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
// Las rutas agregadas se colocan antes del resource para evitar conflictos.
Route::get('products/listDelete', [ProductController::class, 'listDelete'])->name('products.listDelete');
Route::get('products/restoreProduct/{product}', [ProductController::class, 'restoreProduct'])->name('products.restoreProduct');

Route::resource('products', ProductController::class);

// Proveedores
Route::resource('providers', ProviderController::class);

// Ventas
Route::resource('sales', SaleController::class);

// Pedidos
Route::delete('orders/destroyItem/{item}', [OrderController::class, 'destroyItem'])->name('orders.destroyItem');
Route::get('orders/cambiarEstado/{item}', [OrderController::class, 'cambiarEstado'])->name('orders.cambiarEstado');
Route::get('orders/cargarItems/{item}', [OrderController::class, 'cargarItems'])->name('orders.cargarItems');
Route::resource('orders', OrderController::class);

// Categorias
Route::resource('categories', CategoryController::class);


// Usuarios
Route::get('/usuarios/nuevo-usuario', function () {
    return view('usuarios.nuevo-usuario');
});

Route::get('/usuarios/listado-usuarios', function () {
    return view('usuarios.listado-usuarios');
});