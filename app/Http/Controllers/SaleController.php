<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index() {
        return view('sales.index');
    }

    public function create() {
        $products = Product::all();

        return view('sales.create', compact('products'));
    }

    public function store() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function show() {

    }
}
