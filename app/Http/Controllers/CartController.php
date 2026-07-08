<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index(): View
    {
        $cart = Session::get('cart', []);

        $items = collect($cart)
            ->map(function ($quantity, $productId) {
                $product = Product::with('category')->find($productId);

                if (! $product || ! $product->is_active) {
                    return null;
                }

                $quantity = min($quantity, $product->stock);

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
            })
            ->filter()
            ->values();

        $total = $items->sum('subtotal');

        return view('customer.cart.index', compact('items', 'total'));
    }

    /**
     * Add a product to the cart (or increase its quantity).
     */
    public function store(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = Session::get('cart', []);

        $currentQuantity = $cart[$product->id] ?? 0;
        $newQuantity = min($currentQuantity + $validated['quantity'], $product->stock);

        if ($newQuantity < 1) {
            return back()->withErrors(['quantity' => 'Stok produk tidak mencukupi.']);
        }

        $cart[$product->id] = $newQuantity;

        Session::put('cart', $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    /**
     * Update the quantity of a product already in the cart.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = Session::get('cart', []);

        if (! isset($cart[$product->id])) {
            return back();
        }

        $cart[$product->id] = min($validated['quantity'], $product->stock);

        Session::put('cart', $cart);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    /**
     * Remove a product from the cart.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $cart = Session::get('cart', []);

        unset($cart[$product->id]);

        Session::put('cart', $cart);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
