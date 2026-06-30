<x-layouts::app :title="__('Kategori')">

    <div class="p-6">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">
                Data Kategori
            </h1>
            <a href="{{ route('categories.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded">
                Tambah Kategori
            </a>
        </div>
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama Kategori</th>
                    <th class="border p-2">Deskripsi</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td class="border p-2">
                        {{ $loop->iteration }}
                    </td>
                    <td class="border p-2">
                        {{ $category->name }}
                    </td>
                    <td class="border p-2">
                        {{ $category->description }}
                    </td>
                    <td class="border p-2">
                        <a href="{{ route('categories.edit', $category) }}"
                            class="text-blue-500">
                            Edit
                        </a> |
                        <form
                            action="{{ route('categories.destroy', $category) }}"
                            method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                onclick="return confirm('Yakin hapus?')"
                                class="text-red-500">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4">
                        Belum ada data kategori
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts::app>