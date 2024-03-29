<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Product;
use App\Models\ItemSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:eliminar ventas')->only('destroy');
    }

    public function index() {
        $sales = Sale::where('credito', null)->get();
        return view('sales.index', compact('sales'));
    }

    public function credits() {
        $credits = Sale::where('credito', 1)->get();
        return view('sales.credits', compact('credits'));
    }

    public function create() {
        // $products = Product::all();
        $customers = Customer::all();

        return view('sales.create', compact('customers'));
    }

    public function store(Request $request) {
        // return $request;

        $items = $request->carrito;

        // Agregando validacion de datos 
        if(empty($items) || $request->total_sale == '') return 'error';

        // Agregando exception 
        try {
            $sale = new Sale();

            // Pregunta si es fiado o venta
            if($request->credito) {

                $cliente = Customer::find($request->cliente);
                if(!$cliente) {
                    $cliente = new Customer();
                    $cliente->nombre_cliente = $request->cliente;
                    $cliente->save();
                }

                $sale->fill([
                    'total_sale' => $request->total_sale,
                    'credito' => 1,
                    'customer_id' => $cliente->id,
                    'user_id' => auth()->user()->id,
                ]);

            } else {

                $sale->fill([
                    'total_sale' => $request->total_sale,
                    'user_id' => auth()->user()->id,
                ]);
            }

            $sale->save();

            // Crear items de venta o fiado
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

        } catch (\Exception $e) {

            return $e;
        }
        
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
        $sale = Sale::findOrFail($id);
        $items = $sale->itemsSale;

        try {
            foreach ($items as $item) {
                $product = Product::withTrashed()->where('id', $item->product_id)->first();
                $product->stock_prod += $item->cant_sale_prod;
                $product->save();
            }
    
            $sale->delete();
            return 'exito';
            
        } catch (\Exception $e) {
            return 'error';
        }

    }

    public function generarVenta($id) {
        $sale = Sale::find($id);
        $items = $sale->itemsSale;

        foreach ($items as $item) {
            $product = Product::find($item->product_id);
            $product->stock_prod -= $item->cant_sale_prod;
            $product->save();
        }
        
        $sale->credito = null;
        $sale->customer_id = null;
        $sale->save();
        
        return 'exito';

    }

}
