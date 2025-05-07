<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderBy('updated_at', 'desc')->paginate(5);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate and store the product
        // Redirect or return a response
    }

    public function show($id)
    {
        return view('products.show', compact('id'));
    }

    public function edit($id)
    {
        return view('products.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the product
        // Redirect or return a response
    }

    public function destroy($id)
    {
        // Delete the product
        // Redirect or return a response
    }
}
