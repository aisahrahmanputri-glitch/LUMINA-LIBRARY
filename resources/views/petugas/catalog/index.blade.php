@extends('layouts.petugas')

@section('content')
<div class="p-8">

<form method="GET" action="{{ route('catalog.index') }}" class="flex gap-4 mb-6">

    <input type="text" name="search"
        placeholder="Cari Judul, Penulis, atau ISBN"
        value="{{ request('search') }}"
        class="flex-1 border p-3 rounded-xl">

    <select name="kategori" class="border p-3 rounded-xl">
        <option value="">All Categories</option>

        @foreach($kategoris as $k)
            <option value="{{ $k->id }}"
                {{ request('kategori') == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>

    <button class="bg-[#7A2E2E] text-white px-5 rounded-xl">
        Search
    </button>
</form>

@if($books->isEmpty())
<div class="text-center text-gray-400 py-10">
    Data tidak ditemukan 😢
</div>
@endif

<!-- GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

@foreach($books as $book)
<a href="{{ route('catalog.show', $book->id) }}"
   class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">

    <img src="{{ asset('storage/'.$book->cover) }}"
         class="h-48 w-full object-cover rounded mb-3">

    <div class="text-xs bg-gray-100 px-3 py-1 rounded-full mb-2">
        {{ $book->kategori->nama_kategori ?? '-' }}
    </div>

    <div class="font-semibold text-[#7A2E2E]">
        {{ $book->judul }}
    </div>

    <div class="text-xs text-gray-500">
        {{ $book->penulis }}
    </div>

    @if($book->stock_buku > 0)
        <div class="text-green-500 text-sm mt-2">
            {{ $book->stock_buku }} Available
        </div>
    @else
        <div class="text-red-500 text-sm mt-2">
            Unavailable
        </div>
    @endif

</a>
@endforeach

</div>
</div>
@endsection