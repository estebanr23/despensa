<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
        $category = Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function show() {
        
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy($id) {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
