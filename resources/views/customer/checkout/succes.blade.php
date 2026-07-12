@extends('layouts.customer')

@section('title', 'Pesanan Berhasil — ProdukLokal')

@section('content')

<section class="mx-auto max-w-2xl px-6 py-16">
    <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center md:p-12">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-teal-50 text-teal-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        </div>

        <h1 class="mt-5 text-2xl font-bold text-slate-900">Pesanan Berhasil Dibuat!</h1>
        <p class="mt-2 text-slate-500">
            Terima kasih, {{ $orders->first()->customer_name }}. Pesanan kamu sudah kami terima dan akan segera diproses oleh penjual.
        </p>

        <div class="mt-8 space-y-3 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-left text-sm">
            @foreach($orders as $order)
            <div class="flex items-center justify-between {{ !$loop->last ? 'border-b border-slate-200 pb-3' : '' }}">
                <div>
                    <p class="font-medium text-slate-900">{{ $order->product->name }}</p>
                    <p class="text-xs text-slate-500">
                        #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} &middot; {{ $order->quantity }} pcs
                    </p>
                </div>
                <p class="font-semibold text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>
            @endforeach

            <div class="flex justify-between border-t border-slate-300 pt-3">
                <span class="text-slate-500">Total Bayar</span>
                <span class="font-bold text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Metode Pembayaran</span>
                <span class="font-medium text-slate-900">
                    {{ $orders->first()->payment_method === 'cod' ? 'COD (Bayar di Tempat)' : 'Transfer Bank' }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Status</span>
                <span class="rounded-full bg-amber-100 px-2.5 py-0.5 font-medium text-amber-700">Menunggu Konfirmasi</span>
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <a href="{{ route('orders.history') }}" class="rounded-xl bg-teal-600 px-6 py-3 font-semibold text-white transition hover:bg-teal-700">
                Lihat Pesanan Saya
            </a>
            <a href="{{ route('catalog') }}" class="rounded-xl border border-slate-300 px-6 py-3 font-semibold text-slate-700 transition hover:bg-slate-100">
                Belanja Produk Lain
            </a>
        </div>
    </div>
</section>

@endsection
