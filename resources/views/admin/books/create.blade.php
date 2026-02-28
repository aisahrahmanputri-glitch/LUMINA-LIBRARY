@extends('layouts.app')

@section('content')
<div class="p-8 bg-[#F5F5F5] min-h-screen">

@if ($errors->any())
<div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded mb-4">
    <ul>
        @foreach ($errors->all() as $error)
            <li>• {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <div class="max-w-2xl bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-semibold mb-6 text-gray-700">
            Add Book
        </h2>

        <form action="{{ route('admin.books.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf

            <!-- JUDUL -->
            <div>
                <label class="text-sm text-gray-500">Title</label>
                <input type="text" name="judul"
                       class="w-full border p-2 rounded"
                       required>
            </div>

            <!-- PENULIS -->
            <div>
                <label class="text-sm text-gray-500">Author</label>
                <input type="text" name="penulis"
                       class="w-full border p-2 rounded"
                       required>
            </div>

            <!-- PENERBIT -->
            <div>
                <label class="text-sm text-gray-500">Publisher</label>
                <input type="text" name="penerbit"
                       class="w-full border p-2 rounded"
                       required>
            </div>

            <!-- TAHUN -->
            <div>
                <label class="text-sm text-gray-500">Publication Year</label>
                <input type="number" name="tahun_terbit"
                       class="w-full border p-2 rounded"
                       placeholder="e.g. 2024"
                       min="1900" max="{{ date('Y') }}"
                       required>
            </div>

            <!-- ISBN -->
            <div>
                <label class="text-sm text-gray-500">ISBN</label>
                <input type="text" name="isbn"
                       class="w-full border p-2 rounded"
                       required>
            </div>

            <!-- KATEGORI -->
            <div>
                <label class="text-sm text-gray-500">Category</label>
                <select name="kategori_id"
                        class="w-full border p-2 rounded">
                    <option value="">Choose category</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- STOCK -->
            <div>
                <label class="text-sm text-gray-500">Stock</label>
                <input type="number" name="stock_buku"
                       class="w-full border p-2 rounded"
                       required>
            </div>

            <!-- COVER -->
            <div>
                <label class="text-sm text-gray-500">Cover</label>
                <input type="file" name="cover"
                       class="w-full border p-2 rounded"
                       required>
            </div>

            <!-- SINOPSIS -->
            <div>
                <label class="text-sm text-gray-500">Synopsis</label>
                <textarea name="sinopsis"
                          class="w-full border p-2 rounded"
                          required></textarea>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end">
                <button type="submit" class="bg-[#7A2E2E] text-white px-5 py-2 rounded-lg">
                    Save Book
                </button>
            </div>

        </form>
    </div>
</div>
@endsection