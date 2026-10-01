<?php

namespace App\Http\Controllers;

use App\Models\Product;

class TermsController extends Controller
{
    public function index()
    {
        // Get products with warranty
        $warrantyProducts = Product::where('has_warranty', true)
            ->where('is_active', true)
            ->with('category')
            ->get();

        return view('terms.index', compact('warrantyProducts'));
    }
}
