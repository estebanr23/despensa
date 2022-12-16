<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index() {
        // Productos
        $products = Product::all()->count();

        // Productos
        $categories = Category::all()->count();

        // Ventas mensuales
        $fecha_inicio = date("Y-m-01");
        $fecha_fin = date("Y-m-t");

        $cantidad_sales = Sale::where('created_at', '>=', $fecha_inicio)
                        ->where('created_at', '<=', $fecha_fin)
                        ->where('credito', NULL)
                        ->count();

        // Ganancia mensual
        $total_sales = Sale::where('created_at', '>=', $fecha_inicio)
                        ->where('created_at', '<=', $fecha_fin)
                        ->where('credito', NULL)
                        ->sum('total_sale');

        // Cantidad de Fiados
        $cantidad_fiados = Sale::where('created_at', '>=', $fecha_inicio)
                        ->where('created_at', '<=', $fecha_fin)
                        ->where('credito', 1)
                        ->count();

        // Pedidos realizados
        $orders = Order::where('created_at', '>=', $fecha_inicio)
                        ->where('created_at', '<=', $fecha_fin)
                        ->count();

        return view('index', compact('products', 'categories', 'cantidad_sales', 'total_sales', 'cantidad_fiados', 'orders'));
    }
}
