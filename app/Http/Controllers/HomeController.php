<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;


class HomeController extends Controller
{
    public function index()
    {
        $products = Product::query()->limit(6)
            ->orderBy('updated_at', 'desc')
            ->get();
        $categories = Category::query()
            ->get();
        return view('home.index', compact('products', 'categories'));
    }
}
