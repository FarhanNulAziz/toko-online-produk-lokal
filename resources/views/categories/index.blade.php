<x-layouts::app :title="__('Kategori')">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                Data Kategori
            </h1>

            <a
                href="{{ route('categories.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Kategori
            </a>
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
                            <div class="flex justify-center gap-2">
                                <a
                                    href="{{ route('categories.edit', $category) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('categories.destroy', $category) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                        <td colspan="4" class="text-center p-5">
                            Belum ada data kategori
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts::app>