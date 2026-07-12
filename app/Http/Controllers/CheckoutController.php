<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page with a summary of the cart and the order form.
     */
    public function index(): View|RedirectResponse
    {
        $items = $this->cartItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Keranjang kamu masih kosong.');
        }

        $total = $items->sum('subtotal');
        return view('customer.checkout.index', compact('items', 'total'));
    }

    /**
     * Create one order per cart line item, decrement stock, and clear the cart.
     */
    public function store(Request $request): RedirectResponse
    {
        $items = $this->cartItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index');
        }
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'payment_method' => ['required', 'in:cod,transfer'],
        ]);
        $orderIds = DB::transaction(function () use ($items, $validated) {
            $ids = [];
            foreach ($items as $item) {
                $product = Product::whereKey($item['product']->id)->lockForUpdate()->first();
                if (! $product) {
                    continue;
                }
                $quantity = min($item['quantity'], $product->stock);

                if ($quantity < 1) {
                    continue;
                }
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'customer_name' => $validated['customer_name'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'quantity' => $quantity,
                    'total_price' => $product->price * $quantity,
                    'payment_method' => $validated['payment_method'],
                    'status' => 'pending',
                    'order_date' => now(),
                ]);
                $product->decrement('stock', $quantity);

                $ids[] = $order->id;
            }
            return $ids;
        });
        if (empty($orderIds)) {
            return back()->withErrors(['quantity' => 'Stok produk di keranjang sudah tidak mencukupi.']);
        }
        Session::forget('cart');
        return redirect()->route('checkout.success', ['ids' => implode(',', $orderIds)]);
    }

    /**
     * Show the order confirmation page for the given order IDs.
     */
    public function success(Request $request): View|RedirectResponse
    {
        $ids = array_filter(explode(',', (string) $request->query('ids')));

        if (empty($ids)) {
            return redirect()->route('home');
        }
        $orders = Order::with('product')
            ->whereIn('id', $ids)
            ->where('user_id', Auth::id())
            ->get();

        if ($orders->isEmpty()) {
            return redirect()->route('home');
        }
        $total = $orders->sum('total_price');
        return view('customer.checkout.success', compact('orders', 'total'));
    }

    /**
     * Build the current cart as a collection of {product, quantity, subtotal}.
     */
    private function cartItems(): Collection
    {
        $cart = Session::get('cart', []);
        return collect($cart)
            ->map(function ($quantity, $productId) {
                $product = Product::with('category')->find($productId);
                if (! $product || ! $product->is_active) {
                    return null;
                }
                $quantity = min($quantity, $product->stock);
                if ($quantity < 1) {
                    return null;
                }
                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
            })
            ->filter()
            ->values();
    }
}
