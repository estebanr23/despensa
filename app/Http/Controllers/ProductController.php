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
    public function __construct()
    {
        $this->middleware('can:eliminar productos')->only('destroy');
    }

    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(ProductStore $request) {

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

        $messages = [
            'codigo.required' => 'El codigo es requerido.',
            'codigo.unique' => 'El codigo ya existe.',
            'nombre_prod.required' => 'El nombre es requerido.',
            'nombre_prod.unique' => 'El nombre ya existe.',
            'precio_prod.required' => 'El precio es requerido.',
        ];
        
        // Para validar un campo unico sin que arroje error al actualizar el campo por lo que ya existe ese codigo o nombre en la tabla de product
        Validator::make($request->all(), [
            'codigo' => [
                'required',
                Rule::unique('products', 'codigo')->ignore($request->id),
                'max:13'
            ],
            'nombre_prod' => [
                'required',
                Rule::unique('products')->ignore($request->id),
                'max:60'
            ],
            'precio_prod' => 'required|numeric',
        ], $messages)->validate();

        try {
            $product->update($request->all());
            return 'exito';
        } catch (QueryException $exception) {
            return 'error';
        }
    }

    // Se utiliza para agregar los productos al carrito
    public function show($codigo) {
        $product = Product::where('codigo', $codigo)->firstOrFail();
        return $product;
    }

    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();
        return 'exito';
    }

    public function listDelete() {
        $products = Product::onlyTrashed()->get();
        return view('products.listDelete', compact('products'));
    }

    public function restoreProduct($id) {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        $product->restore();
        return 'exito';
    }

}
