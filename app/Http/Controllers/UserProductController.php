<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserProductController extends Controller
{
    /**
     * Display all products for users.
     */
    public function index()
    {
        $products = Product::all();
        return view('user.products.index', compact('products'));
    }

    /**
     * Show a specific product.
     */
    public function show(Product $product)
    {
        return view('user.products.show', compact('product'));
    }
}
