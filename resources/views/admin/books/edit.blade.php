@extends('layouts.app')

@section('content')
<div class="p-8 max-w-3xl">

    <h1 class="text-2xl font-semibold mb-6 text-[#7A2E2E]">
        Edit Book
    </h1>

    {{-- ✅ ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ SUCCESS --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.books.update', $book->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4 bg-white p-6 rounded-2xl shadow">

        @csrf
        @method('PUT')

        <!-- TITLE -->
        <div>
            <label class="block mb-1 text-sm">Title</label>
            <input type="text" name="judul"
                   value="{{ old('judul', $book->judul) }}"
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]">
        </div>

        <!-- AUTHOR -->
        <div>
            <label class="block mb-1 text-sm">Author</label>
            <input type="text" name="penulis"
                   value="{{ old('penulis', $book->penulis) }}"
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]">
        </div>

        <!-- PUBLISHER -->
        <div>
            <label class="block mb-1 text-sm">Publisher</label>
            <input type="text" name="penerbit"
                   value="{{ old('penerbit', $book->penerbit) }}"
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-[#7A2E2E]">
        </div>

        <!-- YEAR -->
        <div>
            <label class="block mb-1 text-sm">Publication Year</label>
            <input type="date" name="tahun_terbit"
                   value="{{ old('tahun_terbit', \Carbon\Carbon::parse($book->tahun_terbit)->format('Y-m-d')) }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- ISBN -->
        <div>
            <label class="block mb-1 text-sm">ISBN</label>
            <input type="text" name="isbn"
                   value="{{ old('isbn', $book->isbn) }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- CATEGORY -->
        <div>
            <label class="block mb-1 text-sm">Category</label>
            <select name="kategori_id" class="w-full border p-2 rounded">
                <option value="">Choose category</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}"
                        {{ old('kategori_id', $book->kategori_id) == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- STOCK -->
        <div>
            <label class="block mb-1 text-sm">Stock</label>
            <input type="number" name="stock_buku"
                   value="{{ old('stock_buku', $book->stock_buku) }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- COVER -->
        <div>
            <label class="block mb-1 text-sm">Cover</label>

            @if($book->cover)
                <img src="{{ asset('storage/'.$book->cover) }}"
                     class="w-20 mb-2 rounded shadow">
            @endif

            <input type="file" name="cover"
                   class="w-full border p-2 rounded">
        </div>

        <!-- SINOPSIS -->
        <div>
            <label class="block mb-1 text-sm">Sinopsis</label>
            <textarea name="sinopsis"
                      rows="4"
                      class="w-full border p-2 rounded">{{ old('sinopsis', $book->sinopsis) }}</textarea>
        </div>

        <!-- BUTTON -->
        <div class="pt-2">
            <button class="bg-[#7A2E2E] hover:bg-[#5c1f1f] text-white px-5 py-2 rounded-lg transition">
                Update Book
            </button>
        </div>

    </form>
</div>
@endsection