<x-layouts::app :title="__('Dashboard')">
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">
            Dashboard Admin
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="rounded-lg border p-6 shadow">
                <h2 class="text-gray-500">
                    Total Produk
                </h2>
                <p class="text-4xl font-bold mt-2">
                    {{ $totalProducts }}
                </p>
            </div>
            <div class="rounded-lg border p-6 shadow">
                <h2 class="text-gray-500">
                    Total Kategori
                </h2>
                <p class="text-4xl font-bold mt-2">
                    {{ $totalCategories }}
                </p>
            </div>
            <div class="rounded-lg border p-6 shadow">
                <h2 class="text-gray-500">
                    Total Pesanan
                </h2>
                <p class="text-4xl font-bold mt-2">
                    {{ $totalOrders }}
                </p>
            </div>
            <div class="rounded-lg border p-6 shadow">
                <h2 class="text-gray-500">
                    Total Customer
                </h2>
                <p class="text-4xl font-bold mt-2">
                    {{ $totalCustomers }}
                </p>
            </div>
        </div>
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">
                Produk Terbaru
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="border p-2">Nama Produk</th>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Harga</th>
                            <th class="border p-2">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestProducts as $product)
                        <tr>
                            <td class="border p-2">{{ $product->name }}</td>
                            <td class="border p-2">{{ $product->category->name }}</td>
                            <td class="border p-2">
                                Rp {{ number_format($product->price,0,',','.') }}
                            </td>
                            <td class="border p-2">
                                {{ $product->stock }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>