@extends('layouts.customer')

@section('title', 'ProdukLokal — Etalase UMKM Lokal Indonesia')
@section('meta_description', 'Belanja produk asli UMKM lokal Indonesia — kain tenun, kerajinan kayu dan rotan, hingga perlengkapan rumah tangga ramah lingkungan, langsung dari penjualnya.')

@section('content')

<!-- HERO -->
<section class="relative overflow-hidden bg-neutral-950">
    <svg class="pointer-events-none absolute inset-0 h-full w-full opacity-[0.07]" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="woven" width="28" height="28" patternUnits="userSpaceOnUse">
                <path d="M0 14h28M14 0v28" stroke="white" stroke-width="1" />
                <circle cx="14" cy="14" r="3" fill="none" stroke="white" stroke-width="1" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#woven)" />
    </svg>
    <div class="relative mx-auto grid max-w-7xl gap-10 px-6 py-20 md:grid-cols-2 md:items-center md:py-28">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full border border-teal-400/30 bg-teal-400/10 px-4 py-1.5 text-xs font-medium text-teal-300">
                <span class="h-1.5 w-1.5 rounded-full bg-teal-400"></span>
                Dibuat oleh tangan, dijaga oleh cerita
            </span>
            <h1 class="mt-6 text-4xl font-bold leading-tight tracking-tight text-white md:text-5xl">
                Belanja produk asli buatan UMKM lokal Indonesia
            </h1>
            <p class="mt-5 max-w-lg text-slate-300">
                Dari kain tenun, kerajinan kayu dan rotan, sampai perlengkapan rumah tangga ramah lingkungan —
                setiap produk di sini punya nama penjual dan cerita di baliknya.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('catalog') }}"
                    class="rounded-xl bg-teal-400 px-6 py-3 font-semibold text-neutral-950 transition hover:bg-teal-300">
                    Belanja Sekarang
                </a>
                <a href="#kategori"
                    class="rounded-xl border border-white/20 px-6 py-3 font-semibold text-white transition hover:bg-white/10">
                    Lihat Kategori
                </a>
            </div>
        </div>
        <div class="flex items-start gap-5">
            @php
                $showcaseStyles = [
                    ['width' => 'w-[38%]', 'offset' => ''],
                    ['width' => 'w-[34%]', 'offset' => 'translate-y-16'],
                    ['width' => 'w-[24%]', 'offset' => 'translate-y-6'],
                ];
            @endphp
            @forelse($products->take(3) as $showcase)
            @php $style = $showcaseStyles[$loop->index] ?? end($showcaseStyles); @endphp
            <a href="{{ route('product.show', $showcase) }}"
                class="group flex flex-shrink-0 flex-col {{ $style['width'] }} {{ $style['offset'] }}">
                <div class="overflow-hidden rounded-2xl bg-white shadow-[0_0_25px_-6px_rgba(45,212,191,0.55)] ring-1 ring-teal-400/40 transition duration-300 group-hover:shadow-[0_0_35px_-4px_rgba(45,212,191,0.8)] group-hover:ring-teal-400/70">
                    <div class="aspect-[4/5] overflow-hidden">
                        @if($showcase->image)
                        <img src="{{ asset('storage/' . $showcase->image) }}" alt="{{ $showcase->name }}"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                        <div class="flex h-full w-full items-center justify-center text-slate-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M3 7.5v9L12 21m-9-4.5L12 21m0 0 9-4.5m0-9L12 3m9 4.5v9L12 21" />
                            </svg>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="mt-3 px-1">
                    <p class="line-clamp-1 text-sm font-medium text-white">{{ $showcase->name }}</p>
                    <p class="text-xs font-semibold text-teal-400">Rp {{ number_format($showcase->price, 0, ',', '.') }}</p>
                </div>
            </a>
            @empty
            <div class="rounded-2xl border border-white/10 bg-white/5 p-10 text-center text-slate-400">
                Belum ada produk untuk ditampilkan.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- VALUE PROPS -->
<section class="border-b border-slate-200 bg-white opacity-0 translate-y-6 transition duration-700 ease-out" data-reveal>
    <div class="mx-auto grid max-w-7xl gap-8 px-6 py-12 sm:grid-cols-2 lg:grid-cols-4">
        @foreach([
            ['title' => 'Asli Buatan Lokal', 'desc' => 'Setiap produk dibuat oleh pelaku UMKM, bukan produk pabrikan massal.'],
            ['title' => 'Harga Transparan', 'desc' => 'Harga langsung dari penjual, tanpa lapisan markup yang tidak jelas.'],
            ['title' => 'Pesan Tanpa Ribet', 'desc' => 'Pilih produk, isi alamat, dan pesanan langsung diteruskan ke penjual.'],
            ['title' => 'Dukung Ekonomi Lokal', 'desc' => 'Setiap pembelian membantu perajin dan pelaku usaha kecil bertahan.'],
        ] as $value)
        <div>
            <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-teal-50 text-teal-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            <h3 class="font-semibold text-slate-900">{{ $value['title'] }}</h3>
            <p class="mt-1 text-sm text-slate-500">{{ $value['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- CATEGORIES -->
<section id="kategori" class="mx-auto max-w-7xl scroll-mt-20 px-6 py-16 opacity-0 translate-y-6 transition duration-700 ease-out" data-reveal>
    <div class="mb-8 flex items-end justify-between">
        <div>
            <p class="text-sm font-medium text-teal-700">Jelajahi</p>
            <h2 class="text-2xl font-bold text-slate-900">Kategori Produk</h2>
        </div>
        <a href="{{ route('catalog') }}" class="hidden text-sm font-medium text-teal-700 hover:underline sm:block">
            Lihat semua &rarr;
        </a>
    </div>

    @if($categories->isEmpty())
    <p class="rounded-2xl border border-dashed border-slate-300 p-10 text-center text-slate-500">
        Belum ada kategori tersedia.
    </p>
    @else
    <div class="grid grid-flow-col grid-rows-2 auto-cols-[280px] gap-5 overflow-x-auto pb-4">
        @foreach($categories as $category)
        <a href="{{ route('catalog', ['category' => $category->id]) }}"
            class="group flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-teal-300 hover:shadow-lg hover:shadow-slate-200/70">
            <div>
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-teal-600 text-lg font-bold text-white">
                    {{ mb_substr($category->name, 0, 1) }}
                </div>
                <h3 class="font-semibold text-slate-900 group-hover:text-teal-700">{{ $category->name }}</h3>
                <p class="mt-2 line-clamp-2 text-sm text-slate-500">{{ $category->description }}</p>
            </div>
            <p class="mt-5 text-sm font-medium text-teal-700">
                {{ $category->products_count }} produk &rarr;
            </p>
        </a>
        @endforeach
    </div>
    @endif
</section>

<!-- FEATURED PRODUCTS -->
<section class="bg-white py-16 opacity-0 translate-y-6 transition duration-700 ease-out" data-reveal>
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-8 flex items-end justify-between">
            <div>
                <p class="text-sm font-medium text-teal-700">Baru ditambahkan</p>
                <h2 class="text-2xl font-bold text-slate-900">Produk Terbaru</h2>
            </div>
            <a href="{{ route('catalog') }}" class="hidden text-sm font-medium text-teal-700 hover:underline sm:block">
                Lihat semua &rarr;
            </a>
        </div>

        @if($products->isEmpty())
        <p class="rounded-2xl border border-dashed border-slate-300 p-10 text-center text-slate-500">
            Belum ada produk tersedia saat ini.
        </p>
        @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($products as $product)
            @include('customer.partials.product-card', ['product' => $product])
            @endforeach
        </div>
        @endif

        <div class="mt-8 text-center sm:hidden">
            <a href="{{ route('catalog') }}" class="text-sm font-medium text-teal-700 hover:underline">
                Lihat semua produk &rarr;
            </a>
        </div>
    </div>
</section>

<!-- ABOUT / CTA -->
<section id="tentang" class="mx-auto max-w-7xl scroll-mt-20 px-6 py-16 opacity-0 translate-y-6 transition duration-700 ease-out" data-reveal>
    <div class="grid gap-10 rounded-3xl bg-teal-700 p-10 text-white md:grid-cols-2 md:items-center md:p-14">
        <div>
            <h2 class="text-2xl font-bold md:text-3xl">Tentang ProdukLokal</h2>
            <p class="mt-4 text-teal-50">
                ProdukLokal adalah etalase digital yang mempertemukan pelaku UMKM dengan pembeli yang ingin
                mendukung produk buatan Indonesia. Setiap kategori — fashion, kebutuhan rumah tangga, hingga
                produk ramah lingkungan — dikurasi dari penjual lokal yang tercatat langsung pada setiap produk.
            </p>
        </div>
        <div class="flex flex-col gap-4 sm:flex-row md:justify-end">
            <a href="{{ route('catalog') }}"
                class="rounded-xl bg-white px-6 py-3 text-center font-semibold text-teal-700 transition hover:bg-teal-50">
                Mulai Belanja
            </a>
        </div>
    </div>
</section>

@endsection
