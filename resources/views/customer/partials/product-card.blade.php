<a href="{{ route('product.show', $product) }}"
    class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-200/70">
    <div class="relative aspect-square w-full overflow-hidden bg-slate-100">
        @if($product->image)
        <img
            src="{{ asset('storage/' . $product->image) }}"
            alt="{{ $product->name }}"
            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        @else
        <div class="flex h-full w-full items-center justify-center text-slate-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M3 7.5v9L12 21m-9-4.5L12 21m0 0 9-4.5m0-9L12 3m9 4.5v9L12 21" />
            </svg>
        </div>
        @endif
        @if($product->category)
        <span class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-teal-700 backdrop-blur">
            {{ $product->category->name }}
        </span>
        @endif
        @if($product->stock <= 0)
        <span class="absolute inset-0 flex items-center justify-center bg-slate-900/50 text-sm font-semibold text-white">
            Stok Habis
        </span>
        @endif
    </div>
    <div class="flex flex-1 flex-col gap-1 p-4">
        <h3 class="line-clamp-1 font-semibold text-slate-900 group-hover:text-teal-700">
            {{ $product->name }}
        </h3>
        @if($product->seller_name)
        <p class="text-xs text-slate-500">
            oleh {{ $product->seller_name }}
        </p>
        @endif
        <div class="mt-auto flex items-center justify-between pt-3">
            <span class="text-lg font-bold text-slate-900">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </span>
            <span class="rounded-lg bg-teal-50 px-3 py-1.5 text-xs font-semibold text-teal-700 transition group-hover:bg-teal-600 group-hover:text-white">
                Lihat
            </span>
        </div>
    </div>
</a>
