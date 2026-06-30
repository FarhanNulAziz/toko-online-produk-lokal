<x-layouts::app :title="__('Tambah Kategori')">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">
            Tambah Kategori
        </h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2">
                    Nama Kategori
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded p-2">

                @error('name')
                <p class="text-red-500 text-sm">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2">
                    Deskripsi
                </label>
                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded p-2">{{ old('description') }}</textarea>
            </div>
            <button
                type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded">
                Simpan
            </button>
            <a
                href="{{ route('categories.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </form>
    </div>
</x-layouts::app>