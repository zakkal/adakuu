<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->view('sitemap.index', [
            'products' => $products,
        ])->header('Content-Type', 'text/xml');
    }
}
