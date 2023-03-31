<?php

namespace App\Http\Controllers;

use App\Models\ItemOrder;
use App\Models\ItemStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:eliminar pedidos')->only('destroy');
        $this->middleware('can:eliminar pedidos')->only('destroyItem');
    }

    public function index() {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create() {
        $providers = Provider::all();
        $products = Product::all();
        return view('orders.create', ['providers' => $providers, 'products' => $products]);
    }

    public function store(Request $request) {

        $items = $request->carrito;
        // *** Agregar validacion ***

        // *** Agregar Excepcion ***
        $order = new Order();
        $order->provider_id = $request->provider;
        $order->save();

        // *** Agregar Excepcion ***
        foreach ($items as $item) {
            ItemOrder::create([
                'cant_order_prod' => $item['cant_order_prod'],
                'product_id' => $item['product_id'],
                'order_id' => $order->id,
                'status_id' => 1,
            ]);
        }

        return "exito";
    }

    public function edit($id) {
        $order = Order::findOrFail($id);
        $items = $order->itemsOrder;
        
        return view('orders.edit', compact('items', 'order'));
    }

    public function update() {
        
    }

    public function show() {
        
    }

    // Eliminar un item de un pedido
    public function destroyItem($id) {
        $item = ItemOrder::findOrFail($id);

        // 1 - Pendiente
        // 2 - Recibido

        if ($item->status_id == 2) { // Si el item esta recibido se debe descontar del stock
            $product = Product::findOrFail($item->product_id);
            $product->stock_prod -= $item->cant_order_prod;
            $product->save();
        }
        
        $item->delete();
        
        return "exito";
    }

    // Cambiar estado de item de un pedido
    public function cambiarEstado($id) {
        $estado = ItemStatus::where('nombre_status', '=', 'Recibido')->first();

        $item = ItemOrder::findOrFail($id);
        $item->status_id = $estado->id;

        // Agregando excepcion
        $product = Product::findOrFail($item->product_id);
        $product->stock_prod += $item->cant_order_prod;
        $product->save();

        // Agregando excepcion
        $item->save();

        return 'exito';
    }

    // Elimar un pedido con sus items relacionados
    public function destroy($id) {
        $order = Order::findOrFail($id);
        $items = $order->itemsOrder;

        foreach ($items as $item) {
            $product = Product::findOrFail($item->product_id);
            $product->stock_prod -= $item->cant_order_prod;
            $product->save();
        }

        $order->delete();

        return 'exito';
    }

    // Metodo para indicar que todos los items de un pedido fueron recibidos y sumar actualizar el stock
    public function cargarItems($id) {
        $order = Order::findOrFail($id);
        $items = $order->itemsOrder;

        // 1 - Pendiente
        // 2 - Recibido
        foreach ($items as $item) {

            if ($item->status_id == 1) { // Consulto si el item esta pendiente

                $product = Product::findOrFail($item->product_id);
                $product->stock_prod += $item->cant_order_prod;
                $product->save();

                $item->status_id = 2; // Paso el item a recibido
                $item->save();
            }
    
        }

        return 'exito';
    }
}
