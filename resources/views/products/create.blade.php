<x-layouts::app :title="__('Tambah Produk')">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">
            Tambah Produk
        </h1>
        <form action="{{ route('products.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-2">Kategori</label>
                <select
                    name="category_id"
                    class="w-full rounded-lg border border-gray-300 bg-white text-black p-2">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label>Nama Produk</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>
            <div class="mt-4">
                <label>Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded p-2"></textarea>
            </div>
            <div class="mt-4">
                <label>Harga</label>
                <input type="number" name="price" class="w-full border rounded p-2" required>
            </div>
            <div class="mt-4">
                <label>Stok</label>
                <input type="number" name="stock" value="0" class="w-full border rounded p-2">
            </div>
            <div class="mt-4">
                <label>Nama Penjual</label>
                <input type="text" name="seller_name" class="w-full border rounded p-2">
            </div>
            <div class="mt-4">
                <label>Gambar Produk</label>
                <input type="file" name="image" class="w-full border rounded p-2">
            </div>
            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>