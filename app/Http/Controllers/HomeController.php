<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function ($q) {
            $q->where('is_active', true);
        }])->get();

        $featuredProducts = Product::where('is_active', true)->take(8)->get();

        return view('home', compact('categories', 'featuredProducts'));
    }

    public function catalogue(Request $request)
    {
        $query = Product::where('is_active', true)->with(['category', 'packages']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('description', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->get();
        $categories = Category::all();

        return view('catalogue', compact('products', 'categories'));
    }
}
