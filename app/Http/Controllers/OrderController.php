<?php

namespace App\Http\Controllers;

use App\Models\ItemOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
        $order = Order::find($id);
        $items = $order->itemsOrder;

        return view('orders.edit', compact('items'));
    }

    public function update() {
        
    }

    public function show() {
        
    }

    public function destroyItem($id) {
        $item = ItemOrder::find($id);
        $item->delete();
        return "exito";
    }

    public function destroy($id) {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index');
    }
}
