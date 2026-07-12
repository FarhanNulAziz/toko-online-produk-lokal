@extends('layouts.customer')

@section('title', 'Riwayat Pesanan — ProdukLokal')

@section('content')

@php
$statusMap = [
    'pending' => ['label' => 'Menunggu Konfirmasi', 'class' => 'bg-amber-100 text-amber-700'],
    'paid' => ['label' => 'Dibayar', 'class' => 'bg-blue-100 text-blue-700'],
    'shipped' => ['label' => 'Dikirim', 'class' => 'bg-indigo-100 text-indigo-700'],
    'done' => ['label' => 'Selesai', 'class' => 'bg-teal-100 text-teal-700'],
    'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-700'],
];
$tabs = ['' => 'Semua'] + array_combine(array_keys($statusMap), array_column($statusMap, 'label'));
@endphp

<section class="mx-auto max-w-4xl px-6 py-10">

    <div class="mb-6">
        <p class="text-sm font-medium text-teal-700">Akun Saya</p>
        <h1 class="text-2xl font-bold text-slate-900 md:text-3xl">Riwayat Pesanan</h1>
    </div>

    <!-- STATUS TABS -->
    <div class="mb-6 flex flex-wrap gap-2 border-b border-slate-200 pb-4">
        @foreach($tabs as $value => $label)
        <a
            href="{{ route('orders.history', $value ? ['status' => $value] : []) }}"
            class="rounded-full px-4 py-1.5 text-sm font-medium transition {{ request('status', '') === $value ? 'bg-teal-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    @if($orders->isEmpty())
    <div class="rounded-2xl border border-dashed border-slate-300 p-16 text-center">
        <p class="font-medium text-slate-700">Belum ada pesanan</p>
        <p class="mt-1 text-sm text-slate-500">Pesanan yang kamu buat akan muncul di sini.</p>
        <a href="{{ route('catalog') }}" class="mt-4 inline-block rounded-xl bg-teal-600 px-6 py-2.5 font-semibold text-white transition hover:bg-teal-700">
            Mulai Belanja
        </a>
    </div>
    @else
    <div class="space-y-4">
        @foreach($orders as $order)
        <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 sm:flex-row sm:items-center">
            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl bg-slate-100">
                @if($order->product?->image)
                <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="h-full w-full object-cover">
                @else
                <div class="flex h-full w-full items-center justify-center text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M3 7.5v9L12 21m-9-4.5L12 21m0 0 9-4.5m0-9L12 3m9 4.5v9L12 21" />
                    </svg>
                </div>
                @endif
            </div>

            <div class="flex-1">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="font-semibold text-slate-900">
                            {{ $order->product->name ?? 'Produk telah dihapus' }}
                        </p>
                        <p class="text-xs text-slate-500">
                            #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} &middot; {{ $order->order_date->translatedFormat('d M Y, H:i') }}
                        </p>
                    </div>
                    <span class="whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-medium {{ $statusMap[$order->status]['class'] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ $statusMap[$order->status]['label'] ?? ucfirst($order->status) }}
                    </span>
                </div>

                <div class="mt-2 flex items-end justify-between">
                    <p class="text-sm text-slate-500">
                        {{ $order->quantity }} pcs &middot; {{ $order->payment_method === 'cod' ? 'COD' : 'Transfer Bank' }}
                    </p>
                    <p class="font-semibold text-slate-900">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
    @endif

</section>

@endsection
