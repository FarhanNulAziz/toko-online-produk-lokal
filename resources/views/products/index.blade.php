<x-layouts::app :title="__('Produk')">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                Data Produk
            </h1>
            <a
                href="{{ route('products.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Produk
            </a>
        </div>
        <div class="mb-6">
            <form action="{{ route('products.index') }}" method="GET" class="flex gap-3">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama produk..."
                    class="w-80 border rounded-lg px-4 py-2 text-black bg-white">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Cari
                </button>
                <a
                    href="{{ route('products.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                    Reset
                </a>
            </form>
        </div>
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Produk</th>
                    <th class="border p-2">Gambar</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Harga</th>
                    <th class="border p-2">Stok</th>
                    <th class="border p-2">Penjual</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td class="border p-2">
                        {{ $products->firstItem() + $loop->index }}
                    </td>
                    <td class="border p-2">
                        {{ $product->name }}
                    </td>
                    <td class="border p-2 text-center">
                        @if($product->image)
                        <div class="w-32 h-32 mx-auto overflow-hidden rounded-lg border bg-gray-100">
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        </div>
                        @else
                        <span class="text-gray-500">Tidak ada</span>
                        @endif
                    </td>
                    <td class="border p-2">
                        {{ $product->category->name }}
                    </td>
                    <td class="border p-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td class="border p-2">
                        {{ $product->stock }}
                    </td>
                    <td class="border p-2">
                        {{ $product->seller_name }}
                    </td>
                    <td class="border p-2">
                        @if($product->is_active)
                        Aktif
                        @else
                        Tidak Aktif
                        @endif
                    </td>
                    <td class="border p-2">
                        <div class="flex justify-center gap-2">
                            <a
                                href="{{ route('products.edit', $product) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition">
                                Edit
                            </a>
                            <form
                                action="{{ route('products.destroy', $product) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center p-5">
                        Belum ada produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts::app>