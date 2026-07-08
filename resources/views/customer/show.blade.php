@extends('layouts.customer')

@section('title', $product->name . ' — ProdukLokal')

@section('content')

<section class="mx-auto max-w-7xl px-6 py-8">

    <!-- BREADCRUMB -->
    <nav class="mb-6 flex flex-wrap items-center gap-1.5 text-sm text-slate-500">
        <a href="{{ route('home') }}" class="hover:text-teal-700">Beranda</a>
        <span>/</span>
        <a href="{{ route('catalog') }}" class="hover:text-teal-700">Produk</a>
        @if($product->category)
        <span>/</span>
        <a href="{{ route('catalog', ['category' => $product->category_id]) }}" class="hover:text-teal-700">{{ $product->category->name }}</a>
        @endif
        <span>/</span>
        <span class="line-clamp-1 text-slate-700">{{ $product->name }}</span>
    </nav>

    <div class="grid gap-10 lg:grid-cols-2">

        <!-- IMAGE -->
        <div class="aspect-square overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
            @else
            <div class="flex h-full w-full items-center justify-center text-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M3 7.5v9L12 21m-9-4.5L12 21m0 0 9-4.5m0-9L12 3m9 4.5v9L12 21" />
                </svg>
            </div>
            @endif
        </div>

        <!-- DETAILS + ORDER FORM -->
        <div>
            @if($product->category)
            <a href="{{ route('catalog', ['category' => $product->category_id]) }}"
                class="inline-block rounded-full bg-teal-50 px-3 py-1 text-xs font-medium text-teal-700">
                {{ $product->category->name }}
            </a>
            @endif

            <h1 class="mt-3 text-2xl font-bold text-slate-900 md:text-3xl">{{ $product->name }}</h1>

            @if($product->seller_name)
            <p class="mt-1 text-sm text-slate-500">Dijual oleh <span class="font-medium text-slate-700">{{ $product->seller_name }}</span></p>
            @endif

            <p class="mt-4 text-3xl font-bold text-slate-900">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p class="mt-1 text-sm {{ $product->stock > 0 ? 'text-teal-700' : 'text-red-600' }}">
                {{ $product->stock > 0 ? "Stok tersedia: {$product->stock}" : 'Stok habis' }}
            </p>

            @if($product->description)
            <p class="mt-5 whitespace-pre-line text-slate-600">{{ $product->description }}</p>
            @endif

            <div class="mt-8 border-t border-slate-200 pt-8">
                @if($product->stock > 0)
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Pesan Produk Ini</h2>

                @if($errors->any())
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('order.store', $product) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="customer_name" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                        <input
                            type="text"
                            id="customer_name"
                            name="customer_name"
                            value="{{ old('customer_name') }}"
                            required
                            maxlength="100"
                            placeholder="Nama penerima"
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
                        <label for="quantity" class="mb-1.5 block text-sm font-medium text-slate-700">Jumlah</label>
                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            value="{{ old('quantity', 1) }}"
                            required
                            min="1"
                            max="{{ $product->stock }}"
                            class="w-32 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
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
                        Pesan Sekarang
                    </button>
                </form>
                @else
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-500">
                    Produk ini sedang habis. Silakan cek produk lain dari kategori yang sama di bawah.
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- RELATED PRODUCTS -->
    @if($relatedProducts->isNotEmpty())
    <div class="mt-16 border-t border-slate-200 pt-10">
        <h2 class="mb-6 text-xl font-bold text-slate-900">Produk Serupa</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($relatedProducts as $related)
            @include('customer.partials.product-card', ['product' => $related])
            @endforeach
        </div>
    </div>
    @endif

</section>

@endsection
