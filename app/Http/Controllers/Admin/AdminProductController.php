<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $query = Product::with(['category', 'packages'])->latest();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->paginate(15);

        return view('admin.products.index', compact('products', 'search'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'badge' => ['nullable', 'string', 'max:50'],
            'logo' => ['nullable', 'string', 'max:100'],
            'logo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:2048'],
            'theme_color' => ['nullable', 'string', 'max:50'],
            'has_warranty' => ['nullable', 'boolean'],
            'warranty_days' => ['nullable', 'required_if:has_warranty,1', 'integer', 'min:1'],
            'warranty_terms' => ['nullable', 'string'],
        ]);

        $logoPath = null;

        // Handle logo image upload
        if ($request->hasFile('logo_image')) {
            $logoPath = $request->file('logo_image')->store('logos', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'badge' => $request->badge,
            'description' => $request->description,
            'logo' => $request->logo ?? Str::lower($request->name),
            'logo_image' => $logoPath,
            'theme_color' => $request->theme_color ?? 'blue',
            'is_active' => true,
            'has_warranty' => $request->boolean('has_warranty', false),
            'warranty_days' => $request->has_warranty ? $request->warranty_days : null,
            'warranty_terms' => $request->has_warranty ? $request->warranty_terms : null,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $product = Product::with('packages')->findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'badge' => ['nullable', 'string', 'max:50'],
            'logo' => ['nullable', 'string', 'max:100'],
            'logo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:2048'],
            'theme_color' => ['nullable', 'string', 'max:50'],
            'has_warranty' => ['nullable', 'boolean'],
            'warranty_days' => ['nullable', 'required_if:has_warranty,1', 'integer', 'min:1'],
            'warranty_terms' => ['nullable', 'string'],
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'badge' => $request->badge,
            'description' => $request->description,
            'logo' => $request->logo ?? $product->logo,
            'theme_color' => $request->theme_color ?? $product->theme_color,
            'has_warranty' => $request->boolean('has_warranty', false),
            'warranty_days' => $request->has_warranty ? $request->warranty_days : null,
            'warranty_terms' => $request->has_warranty ? $request->warranty_terms : null,
        ];

        // Handle logo image upload
        if ($request->hasFile('logo_image')) {
            // Delete old logo if exists
            if ($product->logo_image) {
                \Storage::disk('public')->delete($product->logo_image);
            }

            $data['logo_image'] = $request->file('logo_image')->store('logos', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->packages()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Store a new package for a product.
     */
    public function storePackage(Request $request, int $productId)
    {
        $product = Product::findOrFail($productId);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'badge' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'terms' => ['nullable', 'string'],
        ]);

        $product->packages()->create([
            'name' => $request->name,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
            'stock' => $request->stock,
            'sold_count' => 0,
            'badge' => $request->badge,
            'is_available' => $request->boolean('is_available', true),
            'description' => $request->description,
            'terms' => $request->terms,
        ]);

        return back()->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Update an existing package.
     */
    public function updatePackage(Request $request, int $packageId)
    {
        $package = Package::findOrFail($packageId);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'badge' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'terms' => ['nullable', 'string'],
        ]);

        // If stock is increased and previously out of stock, re-enable availability
        $isAvailable = $request->boolean('is_available', true);
        if ($request->stock > $package->sold_count && ! $package->hasStock()) {
            $isAvailable = true;
        }

        $package->update([
            'name' => $request->name,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
            'stock' => $request->stock,
            'badge' => $request->badge,
            'is_available' => $isAvailable,
            'description' => $request->description,
            'terms' => $request->terms,
        ]);

        return back()->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Delete a package.
     */
    public function destroyPackage(int $packageId)
    {
        $package = Package::findOrFail($packageId);
        $package->delete();

        return back()->with('success', 'Paket berhasil dihapus.');
    }
}
