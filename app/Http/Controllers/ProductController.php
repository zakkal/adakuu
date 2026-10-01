<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['packages', 'category'])
            ->firstOrFail();

        return view('products.show', compact('product'));
    }
}
