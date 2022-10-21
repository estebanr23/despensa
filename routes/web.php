<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
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
})->middleware('auth');

// Autenticacion
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Productos
// Las rutas agregadas se colocan antes del resource para evitar conflictos.
Route::get('products/listDelete', [ProductController::class, 'listDelete'])->name('products.listDelete')->middleware('auth');
Route::get('products/restoreProduct/{product}', [ProductController::class, 'restoreProduct'])->name('products.restoreProduct')->middleware('auth');

Route::resource('products', ProductController::class)->middleware('auth');

// Proveedores
Route::resource('providers', ProviderController::class)->middleware('auth');

// Ventas
Route::resource('sales', SaleController::class)->middleware('auth');

// Pedidos
Route::delete('orders/destroyItem/{item}', [OrderController::class, 'destroyItem'])->name('orders.destroyItem')->middleware('auth');
Route::get('orders/cambiarEstado/{item}', [OrderController::class, 'cambiarEstado'])->name('orders.cambiarEstado')->middleware('auth');
Route::get('orders/cargarItems/{item}', [OrderController::class, 'cargarItems'])->name('orders.cargarItems')->middleware('auth');
Route::resource('orders', OrderController::class)->middleware('auth');

// Categorias
Route::resource('categories', CategoryController::class)->middleware('auth');

// Usuarios
Route::resource('users', UserController::class)->middleware('auth');

