@extends('layouts.customer')

@section('title', 'Semua Produk — ProdukLokal')

@section('content')

<section class="mx-auto max-w-7xl px-6 py-10">

    <div class="mb-8">
        <p class="text-sm font-medium text-teal-700">Katalog</p>
        <h1 class="text-2xl font-bold text-slate-900 md:text-3xl">Semua Produk</h1>
        <p class="mt-1 text-sm text-slate-500">
            Menampilkan {{ $products->total() }} produk dari pelaku UMKM lokal.
        </p>
    </div>

    <div class="grid gap-8 lg:grid-cols-[240px_1fr]">

        <!-- FILTER SIDEBAR -->
        <aside class="lg:sticky lg:top-24 lg:self-start">
            <form action="{{ route('catalog') }}" method="GET" class="space-y-5 rounded-2xl border border-slate-200 bg-white p-5">
                <div>
                    <label for="search" class="mb-1.5 block text-sm font-medium text-slate-700">Cari Produk</label>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama produk..."
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
                </div>

                <div>
                    <p class="mb-1.5 text-sm font-medium text-slate-700">Kategori</p>
                    <div class="space-y-1.5">
                        <label class="flex cursor-pointer items-center gap-2 text-sm text-slate-600">
                            <input
                                type="radio"
                                name="category"
                                value=""
                                class="text-teal-600 focus:ring-teal-500"
                                {{ request()->filled('category') ? '' : 'checked' }}
                                onchange="this.form.submit()">
                            Semua Kategori
                        </label>
                        @foreach($categories as $category)
                        <label class="flex cursor-pointer items-center justify-between gap-2 text-sm text-slate-600">
                            <span class="flex items-center gap-2">
                                <input
                                    type="radio"
                                    name="category"
                                    value="{{ $category->id }}"
                                    class="text-teal-600 focus:ring-teal-500"
                                    {{ (string) request('category') === (string) $category->id ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                {{ $category->name }}
                            </span>
                            <span class="text-xs text-slate-400">{{ $category->products_count }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-2 pt-1">
                    <button type="submit" class="flex-1 rounded-lg bg-teal-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
                        Terapkan
                    </button>
                    <a href="{{ route('catalog') }}" class="flex-1 rounded-lg border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-100">
                        Reset
                    </a>
                </div>
            </form>
        </aside>

        <!-- PRODUCT GRID -->
        <div>
            @if($products->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 p-16 text-center">
                <p class="font-medium text-slate-700">Produk tidak ditemukan</p>
                <p class="mt-1 text-sm text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                <a href="{{ route('catalog') }}" class="mt-4 inline-block text-sm font-medium text-teal-700 hover:underline">
                    Reset filter
                </a>
            </div>
            @else
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($products as $product)
                @include('customer.partials.product-card', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</section>

@endsection
