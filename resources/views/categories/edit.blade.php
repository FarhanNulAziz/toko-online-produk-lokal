<x-layouts::app :title="__('Edit Kategori')">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">
            Edit Kategori
        </h1>
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label>Nama Kategori</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    class="w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded p-2">{{ old('description', $category->description) }}</textarea>
            </div>
            <button
                class="bg-blue-500 text-white px-4 py-2 rounded">
                Update
            </button>
            <a
                href="{{ route('categories.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </form>
    </div>
</x-layouts::app>