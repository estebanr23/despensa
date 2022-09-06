<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index() {
        return view('products.index');
    }

    public function create() {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request) {

        $request->validate([
            'codigo' => 'required|unique:products,codigo|max:10',
            'nombre_prod' => 'required|string|unique:products,nombre_prod|max:60',
            'precio_prod' => 'required|numeric',
            'stock_prod' => 'required|integer',
        ]);

        $product = Product::create($request->all());
        return view('products.index');
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, Product $product) {

        $request->validate([
            'precio_prod' => 'required|numeric',
            'stock_prod' => 'required|integer',
        ]);

        $product->update($request->all());
        return view('products.index');
    }

    public function show() {

    }

}
