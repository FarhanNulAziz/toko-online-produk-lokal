<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
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
     * Display a single product with its order form.
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

    /**
     * Store a new guest order for the given product.
     */
    public function storeOrder(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cod,transfer',
        ]);

        if ($validated['quantity'] > $product->stock) {
            return back()
                ->withErrors(['quantity' => 'Stok tidak mencukupi. Sisa stok: ' . $product->stock])
                ->withInput();
        }

        $order = Order::create([
            'product_id' => $product->id,
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'quantity' => $validated['quantity'],
            'total_price' => $product->price * $validated['quantity'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'order_date' => now(),
        ]);

        $product->decrement('stock', $validated['quantity']);

        return redirect()
            ->route('order.success', $order)
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Display the order confirmation page.
     */
    public function orderSuccess(Order $order): View
    {
        $order->load('product.category');

        return view('customer.order-success', compact('order'));
    }
}
