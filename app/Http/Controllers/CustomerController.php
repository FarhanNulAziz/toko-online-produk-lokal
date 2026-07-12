<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display the customer landing page.
     */
    public function home(): View
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('customer.home', compact('categories', 'products'));
    }

    /**
     * Display the full product catalog with search and category filtering.
     */
    public function catalog(Request $request): View
    {
        $categories = Category::withCount('products')->orderBy('name')->get();

        $query = Product::with('category')->where('is_active', true);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('customer.catalog', compact('categories', 'products'));
    }

    /**
     * Display a single product with its add-to-cart form.
     */
    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load('category');

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('customer.show', compact('product', 'relatedProducts'));
    }
}

