@extends('layouts.customer')

@section('title', 'Keranjang — ProdukLokal')

@section('content')

<section class="mx-auto max-w-5xl px-6 py-10">

    <div class="mb-8">
        <p class="text-sm font-medium text-teal-700">Keranjang</p>
        <h1 class="text-2xl font-bold text-slate-900 md:text-3xl">Keranjang Belanja</h1>
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

    @if($items->isEmpty())
    <div class="rounded-2xl border border-dashed border-slate-300 p-16 text-center">
        <p class="font-medium text-slate-700">Keranjang kamu masih kosong</p>
        <p class="mt-1 text-sm text-slate-500">Yuk mulai belanja produk UMKM lokal favoritmu.</p>
        <a href="{{ route('catalog') }}" class="mt-4 inline-block rounded-xl bg-teal-600 px-6 py-2.5 font-semibold text-white transition hover:bg-teal-700">
            Lihat Produk
        </a>
    </div>
    @else
    <div class="grid gap-8 lg:grid-cols-[1fr_320px]">

        <!-- ITEMS -->
        <div class="space-y-4">
            @foreach($items as $item)
            <div class="flex gap-4 rounded-2xl border border-slate-200 bg-white p-4">
                <a href="{{ route('product.show', $item['product']) }}" class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl bg-slate-100">
                    @if($item['product']->image)
                    <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="h-full w-full object-cover">
                    @else
                    <div class="flex h-full w-full items-center justify-center text-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M3 7.5v9L12 21m-9-4.5L12 21m0 0 9-4.5m0-9L12 3m9 4.5v9L12 21" />
                        </svg>
                    </div>
                    @endif
                </a>

                <div class="flex flex-1 flex-col justify-between">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <a href="{{ route('product.show', $item['product']) }}" class="font-semibold text-slate-900 hover:text-teal-700">
                                {{ $item['product']->name }}
                            </a>
                            <p class="text-sm text-slate-500">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                        </div>
                        <form action="{{ route('cart.destroy', $item['product']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 transition hover:text-red-600" aria-label="Hapus dari keranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9.5 7V5a1.5 1.5 0 0 1 1.5-1.5h2A1.5 1.5 0 0 1 14.5 5v2m2.5 0-.6 12a2 2 0 0 1-2 1.85H8.6a2 2 0 0 1-2-1.85L6 7" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="flex items-end justify-between">
                        <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <label for="quantity-{{ $item['product']->id }}" class="text-sm text-slate-500">Jumlah</label>
                            <input
                                type="number"
                                id="quantity-{{ $item['product']->id }}"
                                name="quantity"
                                value="{{ $item['quantity'] }}"
                                min="1"
                                max="{{ $item['product']->stock }}"
                                class="w-16 rounded-lg border border-slate-300 px-2 py-1 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
                            <button type="submit" class="rounded-lg border border-slate-300 px-3 py-1 text-sm text-slate-600 transition hover:bg-slate-100">
                                Update
                            </button>
                        </form>
                        <p class="font-semibold text-slate-900">
                            Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- SUMMARY -->
        <aside class="lg:sticky lg:top-24 lg:self-start">
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h2 class="font-semibold text-slate-900">Ringkasan Belanja</h2>
                <div class="mt-4 flex justify-between text-sm text-slate-600">
                    <span>Total ({{ $items->sum('quantity') }} barang)</span>
                    <span class="font-semibold text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <button
                    type="button"
                    disabled
                    class="mt-5 w-full cursor-not-allowed rounded-xl bg-slate-300 py-3 text-center font-semibold text-slate-500">
                    Lanjut ke Checkout
                </button>
                <p class="mt-2 text-center text-xs text-slate-400">
                    Fitur checkout akan segera tersedia.
                </p>

                <a href="{{ route('catalog') }}" class="mt-3 block text-center text-sm font-medium text-teal-700 hover:underline">
                    Lanjut Belanja
                </a>
            </div>
        </aside>
    </div>
    @endif

</section>

@endsection