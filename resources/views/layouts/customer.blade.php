<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d9488">
    <meta name="description" content="@yield('meta_description', 'Etalase digital untuk produk UMKM lokal Indonesia — kain tenun, kerajinan kayu dan rotan, hingga perlengkapan rumah tangga ramah lingkungan.')">

    <title>@yield('title', 'ProdukLokal — Etalase UMKM Lokal Indonesia')</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ProdukLokal">
    <meta property="og:title" content="@yield('title', 'ProdukLokal — Etalase UMKM Lokal Indonesia')">
    <meta property="og:description" content="@yield('meta_description', 'Etalase digital untuk produk UMKM lokal Indonesia — kain tenun, kerajinan kayu dan rotan, hingga perlengkapan rumah tangga ramah lingkungan.')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- PAGE PROGRESS BAR -->
    <div id="page-progress" class="fixed inset-x-0 top-0 z-[100] h-0.5 origin-left scale-x-0 bg-teal-500 transition-transform duration-300 ease-out"></div>

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
                    <a href="{{ route('cart.index') }}" class="relative rounded-xl p-2 text-slate-700 transition hover:bg-slate-100" aria-label="Keranjang">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.994-4.716 2.615-7.22a1.125 1.125 0 0 0-1.11-1.37H5.25M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        @php $cartCount = collect(session('cart', []))->sum(); @endphp
                        @if($cartCount > 0)
                        <span class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-teal-600 text-xs font-semibold text-white">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>
                    @auth
                    <a href="{{ route('orders.history') }}" class="{{ request()->routeIs('orders.history') ? 'text-teal-700 font-medium' : 'text-slate-600 hover:text-teal-700' }} text-sm transition">
                        Pesanan Saya
                    </a>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800">
                        Dashboard Admin
                    </a>
                    @endif
                    <span class="text-sm text-slate-600">Hai, {{ auth()->user()->name }}</span>
                    <form action="{{ route('customer.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-xl border border-slate-300 px-4 py-2 transition hover:bg-slate-100">
                            Keluar
                        </button>
                    </form>
                    @else
                    <a href="{{ route('customer.login') }}"
                        class="rounded-xl border border-slate-300 px-4 py-2 transition hover:bg-slate-100">
                        Masuk
                    </a>
                    <a href="{{ route('customer.register') }}"
                        class="rounded-xl bg-teal-600 px-4 py-2 font-medium text-white transition hover:bg-teal-700">
                        Daftar
                    </a>
                    @endauth
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
                    <a href="{{ route('cart.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 {{ request()->routeIs('cart.index') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-slate-100' }}">
                        <span>Keranjang</span>
                        @php $mobileCartCount = collect(session('cart', []))->sum(); @endphp
                        @if($mobileCartCount > 0)
                        <span class="rounded-full bg-teal-600 px-2 py-0.5 text-xs font-semibold text-white">{{ $mobileCartCount }}</span>
                        @endif
                    </a>
                    @auth
                    <a href="{{ route('orders.history') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('orders.history') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-slate-100' }}">
                        Pesanan Saya
                    </a>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="rounded-lg bg-slate-900 px-3 py-2 text-center font-medium text-white hover:bg-slate-800">
                        Dashboard Admin
                    </a>
                    @endif
                    <div class="mt-2 flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2">
                        <span class="text-slate-600">Hai, {{ auth()->user()->name }}</span>
                        <form action="{{ route('customer.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="font-medium text-teal-700">Keluar</button>
                        </form>
                    </div>
                    @else
                    <a href="{{ route('customer.login') }}" class="mt-2 rounded-lg border border-slate-300 px-3 py-2 text-center hover:bg-slate-100">
                        Masuk
                    </a>
                    <a href="{{ route('customer.register') }}" class="rounded-lg bg-teal-600 px-3 py-2 text-center font-medium text-white hover:bg-teal-700">
                        Daftar
                    </a>
                    @endauth
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

    <script>
        (function () {
            var bar = document.getElementById('page-progress');

            function startProgress() {
                bar.style.transform = 'scaleX(0.7)';
            }

            function resetProgress() {
                bar.style.transition = 'none';
                bar.style.transform = 'scaleX(0)';
                requestAnimationFrame(function () {
                    bar.style.transition = '';
                });
            }

            // Show progress when navigating to another page on this site.
            document.addEventListener('click', function (e) {
                var link = e.target.closest('a[href]');
                if (!link || link.target === '_blank' || link.hasAttribute('download')) return;
                if (!link.href || link.href.indexOf('#') !== -1 && link.href.split('#')[0] === window.location.href.split('#')[0]) return;
                if (link.origin !== window.location.origin) return;
                startProgress();
            });

            // Show progress + disable the submit button while a form is processing.
            document.addEventListener('submit', function (e) {
                var form = e.target;
                if (form.tagName !== 'FORM') return;

                startProgress();

                var submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    submitBtn.dataset.originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
                    submitBtn.innerHTML =
                        '<span class="inline-flex items-center justify-center gap-2">' +
                        '<svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">' +
                        '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>' +
                        '<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>' +
                        '</svg>Memproses...</span>';
                }
            });

            // Reset the bar whenever a page becomes visible (fresh load or back/forward cache).
            window.addEventListener('pageshow', resetProgress);
        })();

        // Fade-reveal sections as they scroll into view.
        (function () {
            var revealEls = document.querySelectorAll('[data-reveal]');
            if (revealEls.length === 0) return;

            if (!('IntersectionObserver' in window)) {
                revealEls.forEach(function (el) {
                    el.classList.remove('opacity-0', 'translate-y-6');
                    el.classList.add('opacity-100', 'translate-y-0');
                });
                return;
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.remove('opacity-0', 'translate-y-6');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    observer.unobserve(entry.target);
                });
            }, { threshold: 0.15 });

            revealEls.forEach(function (el) { observer.observe(el); });
        })();
    </script>
</body>
</html>
