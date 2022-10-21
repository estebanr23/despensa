<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\ItemSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index() {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    public function create() {
        $products = Product::all();

        return view('sales.create', compact('products'));
    }

    public function store(Request $request) {
        $items = $request->carrito;

        // *** Agregar validacion de datos ***

        // *** Agregar exception ***
        $sale = new Sale();

        $sale->fill([
            'total_sale' => $request->total_sale,
            'user_id' => 1,
        ]);
        $sale->save();

        // *** Agregar exception ***
        foreach ($items as $item) {
            ItemSale::create([
                'cant_sale_prod' => $item['cant_sale_prod'],
                'total_item' => $item['total_item'],
                'product_id' => $item['product_id'],
                'sale_id' => $sale->id,
            ]);
            
        }

        // Descontar Stock
        $new_sale = Sale::find($sale->id);
        $new_items = $new_sale->itemsSale;
        foreach ($new_items as $i) {
            $product = Product::find($i->product_id);
            $product->stock_prod -= $i->cant_sale_prod;
            $product->save();
        }

        return 'exito';
    }

    public function edit() {

    }

    public function update() {

    }

    public function show($id) {
        $items = DB::table('sales')
            ->where('sales.id', '=', $id)
            ->join('items_sales', 'sales.id', '=', 'items_sales.sale_id')
            ->join('products', 'items_sales.product_id', '=', 'products.id')
            ->select('cant_sale_prod', 'nombre_prod', 'precio_prod')
            ->get();
            
        return $items;
    }

    public function destroy($id) {
        $sale = Sale::find($id);
        $items = $sale->itemsSale;

        foreach ($items as $item) {
            $product = Product::find($item->product_id);
            $product->stock_prod += $item->cant_sale_prod;
            $product->save();
        }

        $sale->delete();
        return 'exito';
        // return $items;
        // return view('sales.index', compact('sales'));
    }

}
