@extends('layouts.customer')

@section('title', 'Daftar Akun — ProdukLokal')

@section('content')

<section class="mx-auto flex min-h-[70vh] max-w-md items-center px-6 py-16">
    <div class="w-full rounded-3xl border border-slate-200 bg-white p-8">
        <h1 class="text-2xl font-bold text-slate-900">Buat Akun Baru</h1>
        <p class="mt-1 text-sm text-slate-500">Daftar untuk mulai berbelanja produk UMKM lokal.</p>

        @if($errors->any())
        <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('customer.register.store') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
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

            <div>
                <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
            </div>

            <button type="submit" class="w-full rounded-xl bg-teal-600 py-3 font-semibold text-white transition hover:bg-teal-700">
                Daftar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Sudah punya akun?
            <a href="{{ route('customer.login') }}" class="font-medium text-teal-700 hover:underline">Masuk di sini</a>
        </p>
    </div>
</section>

@endsection
