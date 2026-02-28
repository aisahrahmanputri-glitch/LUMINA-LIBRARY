@extends('layouts.petugas')

@section('content')
<div class="p-8 bg-gradient-to-br from-[#fff7f7] via-[#fdf2f2] to-[#ffe4e6] min-h-screen">

    @if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-xl mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="max-w-2xl bg-white rounded-2xl shadow p-6 border border-[#f3d6d6]">

        <h2 class="text-xl font-semibold mb-6 text-[#7A2E2E]">
            Add Book
        </h2>

        <form action="{{ route('petugas.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm text-gray-500">Title</label>
                <input type="text" name="judul"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]" required>
            </div>

            <div>
                <label class="text-sm text-gray-500">Author</label>
                <input type="text" name="penulis"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]" required>
            </div>

            <div>
                <label class="text-sm text-gray-500">Publisher</label>
                <input type="text" name="penerbit"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]" required>
            </div>

            <!-- 🔥 FIX UTAMA -->
            <div>
                <label class="text-sm text-gray-500">Publication Year</label>
                <input type="number" name="tahun_terbit"
                       placeholder="Contoh: 2024"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]" required>
            </div>

            <div>
                <label class="text-sm text-gray-500">ISBN</label>
                <input type="text" name="isbn"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]" required>
            </div>

            <div>
                <label class="text-sm text-gray-500">Category</label>
                <select name="kategori_id"
                        class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]">
                    <option value="">Choose category</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-500">Stock</label>
                <input type="number" name="stock_buku"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]" required>
            </div>

            <div>
                <label class="text-sm text-gray-500">Cover</label>
                <input type="file" name="cover"
                       class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="text-sm text-gray-500">Synopsis</label>
                <textarea name="sinopsis"
                          class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]" rows="3"></textarea>
            </div>

            <div class="flex justify-end">
                <button class="bg-[#7A2E2E] hover:bg-[#5c1f1f] text-white px-5 py-2 rounded-xl transition">
                    Save Book
                </button>
            </div>

        </form>
    </div>
</div>
@endsection