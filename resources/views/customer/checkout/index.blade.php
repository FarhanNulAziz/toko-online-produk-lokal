@extends('layouts.customer')

@section('title', 'Checkout — ProdukLokal')

@section('content')

<section class="mx-auto max-w-5xl px-6 py-10">

    <div class="mb-8">
        <p class="text-sm font-medium text-teal-700">Checkout</p>
        <h1 class="text-2xl font-bold text-slate-900 md:text-3xl">Selesaikan Pesanan</h1>
    </div>

    @if($errors->any())
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
        <ul class="list-inside list-disc space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid gap-8 lg:grid-cols-[1fr_360px]">

        <!-- SHIPPING + PAYMENT FORM -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Detail Pengiriman</h2>

            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="customer_name" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Penerima</label>
                    <input
                        type="text"
                        id="customer_name"
                        name="customer_name"
                        value="{{ old('customer_name', auth()->user()->name) }}"
                        required
                        maxlength="100"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
                </div>

                <div>
                    <label for="phone" class="mb-1.5 block text-sm font-medium text-slate-700">Nomor HP / WhatsApp</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        required
                        maxlength="20"
                        placeholder="08xxxxxxxxxx"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
                </div>

                <div>
                    <label for="address" class="mb-1.5 block text-sm font-medium text-slate-700">Alamat Pengiriman</label>
                    <textarea
                        id="address"
                        name="address"
                        required
                        rows="3"
                        placeholder="Alamat lengkap penerima"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">{{ old('address') }}</textarea>
                </div>

                <div>
                    <p class="mb-1.5 text-sm font-medium text-slate-700">Metode Pembayaran</p>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-slate-300 px-3 py-2.5 text-sm has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                            <input type="radio" name="payment_method" value="cod" required {{ old('payment_method') === 'cod' || !old('payment_method') ? 'checked' : '' }} class="text-teal-600 focus:ring-teal-500">
                            COD (Bayar di Tempat)
                        </label>
                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-slate-300 px-3 py-2.5 text-sm has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                            <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') === 'transfer' ? 'checked' : '' }} class="text-teal-600 focus:ring-teal-500">
                            Transfer Bank
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full rounded-xl bg-teal-600 py-3 font-semibold text-white transition hover:bg-teal-700">
                    Buat Pesanan
                </button>
            </form>
        </div>

        <!-- ORDER SUMMARY -->
        <aside class="lg:sticky lg:top-24 lg:self-start">
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h2 class="mb-4 font-semibold text-slate-900">Ringkasan Pesanan</h2>

                <div class="max-h-80 space-y-3 overflow-y-auto pr-1">
                    @foreach($items as $item)
                    <div class="flex gap-3">
                        <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-lg bg-slate-100">
                            @if($item['product']->image)
                            <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="line-clamp-1 text-sm font-medium text-slate-900">{{ $item['product']->name }}</p>
                            <p class="text-xs text-slate-500">{{ $item['quantity'] }} x Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="text-sm font-semibold text-slate-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4 flex justify-between border-t border-slate-200 pt-4 text-sm">
                    <span class="text-slate-500">Total ({{ $items->sum('quantity') }} barang)</span>
                    <span class="font-bold text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('cart.index') }}" class="mt-3 block text-center text-sm font-medium text-teal-700 hover:underline">
                    Ubah Keranjang
                </a>
            </div>
        </aside>
    </div>
</section>

@endsection
