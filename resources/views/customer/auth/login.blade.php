@extends('layouts.customer')

@section('title', 'Masuk — ProdukLokal')

@section('content')

<section class="mx-auto flex min-h-[70vh] max-w-md items-center px-6 py-16">
    <div class="w-full rounded-3xl border border-slate-200 bg-white p-8">
        <h1 class="text-2xl font-bold text-slate-900">Masuk ke Akun Kamu</h1>
        <p class="mt-1 text-sm text-slate-500">Masuk untuk melanjutkan belanja dan memesan produk.</p>

        @if($errors->any())
        <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('customer.login.store') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-teal-600 focus:ring-teal-500">
                Ingat saya
            </label>

            <button type="submit" class="w-full rounded-xl bg-teal-600 py-3 font-semibold text-white transition hover:bg-teal-700">
                Masuk
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Belum punya akun?
            <a href="{{ route('customer.register') }}" class="font-medium text-teal-700 hover:underline">Daftar sekarang</a>
        </p>
    </div>
</section>

@endsection