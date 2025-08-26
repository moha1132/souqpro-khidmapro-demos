<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View {
        $products = Product::latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    public function create(): View { return view('products.create'); }

    public function store(Request $request): RedirectResponse {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sale_starts_at' => 'nullable|date',
            'sale_ends_at' => 'nullable|date|after:sale_starts_at',
            'sku' => 'nullable|string|max:64',
            'stock' => 'required|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ]);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['user_id'] = $request->user()?->id;
        $validated['is_active'] = (bool)$request->boolean('is_active');
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'تم إنشاء المنتج');
    }

    public function show(Product $product): View { return view('products.show', compact('product')); }

    public function edit(Product $product): View { return view('products.edit', compact('product')); }

    public function update(Request $request, Product $product): RedirectResponse {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sale_starts_at' => 'nullable|date',
            'sale_ends_at' => 'nullable|date|after:sale_starts_at',
            'sku' => 'nullable|string|max:64',
            'stock' => 'required|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ]);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = (bool)$request->boolean('is_active');
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج');
    }

    public function destroy(Product $product): RedirectResponse {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج');
    }
}
