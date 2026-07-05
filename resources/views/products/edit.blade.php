<x-layouts::app :title="__('Edit Produk')">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">
            Edit Produk
        </h1>
        <form action="{{ route('products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-2">Kategori</label>
                <select
                    name="category_id"
                    class="w-full rounded-lg border border-gray-300 bg-white text-black p-2">
                    @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label>Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded p-2" required>
            </div>
            <div class="mt-4">
                <label>Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="mt-4">
                <label>Harga</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded p-2" required>
            </div>
            <div class="mt-4">
                <label>Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border rounded p-2">
            </div>
            <div class="mt-4">
                <label>Nama Penjual</label>
                <input type="text" name="seller_name" value="{{ old('seller_name', $product->seller_name) }}" class="w-full border rounded p-2">
            </div>
            <div class="mt-4">
                <label>Gambar Produk</label>
                @if($product->image)
                <div class="mb-3">
                    <img
                        src="{{ asset('storage/'.$product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-40 rounded border">
                </div>
                @endif
                <input
                    type="file"
                    name="image"
                    class="w-full border rounded p-2">
            </div>
            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-yellow-600 text-white px-5 py-2 rounded">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>