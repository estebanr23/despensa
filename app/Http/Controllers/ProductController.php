<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStore;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(ProductStore $request) {

        /* $request->validate([
            'codigo' => 'required|unique:products,codigo|max:10',
            'nombre_prod' => 'required|string|unique:products,nombre_prod|max:60',
            'precio_prod' => 'required|numeric',
            'stock_prod' => 'required|integer',
        ]); */

        try {
            $product = Product::create($request->all());
            return 'exito';
        } catch (QueryException $exception) {
            return 'error';
        }
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, Product $product) {
        
        // Para validar un campo unico sin que arroje error al actualizar el campo por lo que ya existe ese codigo o nombre en la tabla de product
        Validator::make($request->all(), [
            'codigo' => [
                'required',
                Rule::unique('products')->ignore($request->codigo),
                'max:10'
            ],
            'nombre_prod' => [
                'required',
                Rule::unique('products')->ignore($request->nombre_prod),
                'max:60'
            ],
            'precio_prod' => 'required|numeric',
            'stock_prod' => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    public function show() {

    }

    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }

    public function listDelete() {
        $products = Product::onlyTrashed()->get();
        return view('products.listDelete', compact('products'));
    }

    public function restoreProduct($id) {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        $product->restore();
        return redirect()->route('products.listDelete');
    }

}
