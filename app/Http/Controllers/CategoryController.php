<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        $message = [
            "nombre_cat.required" => "El nombre de la categoria es requerido.",
            "nombre_cat.unique" => "La categoria ya existe.",
            "descripcion.required" => "La descripcion de la categoria es requerida."
        ];

        $request->validate([
            'nombre_cat' => 'required|unique:categories,nombre_cat',
            'descripcion' => 'required',
        ], $message);

        try {
            $category = Category::create($request->all());
            return 'exito';
        } catch (QueryException $exception) {
            return 'error';
        }
    }

    public function show() {
        
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $message = [
            "nombre_cat.required" => "El nombre de la categoria es requerido.",
            "nombre_cat.unique" => "La categoria ya existe.",
            "descripcion.required" => "La descripcion de la categoria es requerida."
        ];

        $request->validate([
            'nombre_cat' => 'required|unique:categories,nombre_cat,'.$category->id,
            'descripcion' => 'required',
        ], $message);

        try {
            $category->update($request->all());
            return 'exito';
        } catch (QueryException $exception) {
            return 'error';
        }
    }

    public function destroy($id) {
        $category = Category::find($id);
        $category->delete();
        return 'exito';
    }
}
