@extends('layouts.petugas')

@section('content')
<div class="p-8 max-w-3xl">

    <h1 class="text-2xl font-bold text-[#7A2E2E] mb-6">
        Edit Book
    </h1>

    <form action="{{ route('petugas.books.update',$book->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4 bg-white p-6 rounded-2xl shadow border border-[#f3d6d6]">
        @csrf
        @method('PUT')

        <!-- TITLE -->
        <div>
            <label class="text-sm text-gray-500">Title</label>
            <input type="text" name="judul"
                   value="{{ $book->judul }}"
                   class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">
        </div>

        <!-- AUTHOR -->
        <div>
            <label class="text-sm text-gray-500">Author</label>
            <input type="text" name="penulis"
                   value="{{ $book->penulis }}"
                   class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">
        </div>

        <!-- PUBLISHER -->
        <div>
            <label class="text-sm text-gray-500">Publisher</label>
            <input type="text" name="penerbit"
                   value="{{ $book->penerbit }}"
                   class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">
        </div>

        <!-- 🔥 FIX TAHUN -->
        <div>
            <label class="text-sm text-gray-500">Publication Year</label>
            <input type="number" name="tahun_terbit"
                   value="{{ $book->tahun_terbit }}"
                   placeholder="Contoh: 2024"
                   class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">
        </div>

        <!-- ISBN -->
        <div>
            <label class="text-sm text-gray-500">ISBN</label>
            <input type="text" name="isbn"
                   value="{{ $book->isbn }}"
                   class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">
        </div>

        <!-- CATEGORY -->
        <div>
            <label class="text-sm text-gray-500">Category</label>
            <select name="kategori_id"
                    class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">
                <option value="">Choose category</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}"
                        {{ $book->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- STOCK -->
        <div>
            <label class="text-sm text-gray-500">Stock</label>
            <input type="number" name="stock_buku"
                   value="{{ $book->stock_buku }}"
                   class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">
        </div>

        <!-- COVER -->
        <div>
            <label class="text-sm text-gray-500">Cover</label>

            <img src="{{ asset('storage/'.$book->cover) }}"
                 class="w-20 mb-2 rounded">

            <input type="file" name="cover"
                   class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">
        </div>

        <!-- SINOPSIS -->
        <div>
            <label class="text-sm text-gray-500">Synopsis</label>
            <textarea name="sinopsis"
                      class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded">{{ $book->sinopsis }}</textarea>
        </div>

        <!-- BUTTON -->
        <button class="bg-[#7A2E2E] hover:bg-[#5c1f1f] text-white px-5 py-2 rounded-xl transition">
            Update Book
        </button>

    </form>
</div>

@endsection