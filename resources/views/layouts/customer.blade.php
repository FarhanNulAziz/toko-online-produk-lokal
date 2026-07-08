<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Produk Lokal')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900">
    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ route('home') }}"
                    class="text-2xl font-bold tracking-tight">
                    Produk<span class="text-teal-600">Lokal</span>
                </a>
                <nav class="hidden items-center gap-8 md:flex">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-teal-700 font-medium' : 'hover:text-teal-700' }} transition">
                        Beranda
                    </a>
                    <a href="{{ route('catalog') }}"
                        class="{{ request()->routeIs('catalog') || request()->routeIs('product.show') ? 'text-teal-700 font-medium' : 'hover:text-teal-700' }} transition">
                        Produk
                    </a>
                    <a href="{{ route('home') }}#tentang"
                        class="hover:text-teal-700 transition">
                        Tentang
                    </a>
                </nav>
                <div class="hidden items-center gap-3 md:flex">
                    <a href="{{ route('login') }}"
                        class="rounded-xl border border-slate-300 px-4 py-2 transition hover:bg-slate-100">
                        Login
                    </a>
                </div>
                <button
                    type="button"
                    onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-slate-700 hover:bg-slate-100 md:hidden"
                    aria-label="Buka menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                    </svg>
                </button>
            </div>
            <div id="mobile-menu" class="hidden border-t border-slate-200 pb-4 md:hidden">
                <nav class="flex flex-col gap-1 pt-3 text-sm">
                    <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-slate-100' }}">
                        Beranda
                    </a>
                    <a href="{{ route('catalog') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('catalog') || request()->routeIs('product.show') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-slate-100' }}">
                        Produk
                    </a>
                    <a href="{{ route('home') }}#tentang" class="rounded-lg px-3 py-2 hover:bg-slate-100">
                        Tentang
                    </a>
                    <a href="{{ route('login') }}" class="mt-2 rounded-lg border border-slate-300 px-3 py-2 text-center hover:bg-slate-100">
                        Login
                    </a>
                </nav>
            </div>
        </div>
    </header>
    <main>
        @if(session('success'))
        <div class="mx-auto mt-4 max-w-7xl px-6">
            <div class="flex items-center gap-2 rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif
        @yield('content')
    </main>
    <footer class="mt-24 border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-10">
            <div class="grid gap-8 md:grid-cols-3">
                <div>
                    <p class="text-xl font-bold tracking-tight">Produk<span class="text-teal-600">Lokal</span></p>
                    <p class="mt-2 max-w-xs text-sm text-slate-500">
                        Etalase digital untuk produk UMKM lokal — dari kain tenun, kerajinan kayu, hingga kebutuhan rumah tangga estetik.
                    </p>
                </div>
                <div class="text-sm text-slate-500">
                    <p class="mb-2 font-semibold text-slate-700">Jelajah</p>
                    <ul class="space-y-1">
                        <li><a href="{{ route('home') }}" class="hover:text-teal-700">Beranda</a></li>
                        <li><a href="{{ route('catalog') }}" class="hover:text-teal-700">Semua Produk</a></li>
                    </ul>
                </div>
                <div class="text-sm text-slate-500">
                    <p class="mb-2 font-semibold text-slate-700">Untuk Penjual</p>
                    <ul class="space-y-1">
                        <li><a href="{{ route('login') }}" class="hover:text-teal-700">Masuk sebagai Admin</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-slate-200 pt-6 text-sm text-slate-500">
                © {{ date('Y') }} Produk Lokal Indonesia
            </div>
        </div>
    </footer>
</body>

</html>