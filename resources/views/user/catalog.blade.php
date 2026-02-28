@extends('layouts.siswa')

@section('content')

<div class="p-6">

    <!-- SEARCH -->
    <form method="GET" action="{{ route('catalog.index') }}" class="flex gap-4 mb-6">

        <input type="text" name="search"
            placeholder="Cari Judul, Penulis, atau ISBN"
            value="{{ request('search') }}"
            class="flex-1 border p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7A2E2E]">

        <select name="kategori"
            class="border p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7A2E2E]">
            <option value="">All Categories</option>

            @foreach($kategoris as $k)
                <option value="{{ $k->id }}"
                    {{ request('kategori') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>

        <button class="bg-[#7A2E2E] text-white px-5 rounded-xl hover:opacity-90 transition">
            Search
        </button>

    </form>

    <!-- EMPTY -->
    @if($books->isEmpty())
        <div class="text-center text-gray-400 py-10">
            Data tidak ditemukan 😢
        </div>
    @endif

    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($books as $book)
        <div class="bg-white rounded-2xl shadow p-4 relative hover:shadow-lg transition text-center">

            <!-- RATING -->
            <div class="absolute top-3 right-3 bg-white px-2 py-1 rounded-full text-xs shadow">
                ⭐ {{ number_format($book->average_rating ?? 0,1) }}
            </div>

            <!-- COVER -->
            <img src="{{ asset('storage/'.$book->cover) }}"
                class="w-full h-[220px] object-cover rounded-xl">

            <!-- CATEGORY -->
            <div class="mt-3 flex justify-center">
                <span class="text-xs bg-gray-100 px-3 py-1 rounded-full">
                    {{ $book->kategori->nama_kategori ?? '-' }}
                </span>
            </div>

            <!-- TITLE -->
            <h2 class="mt-2 font-semibold text-[#7A2E2E]">
                {{ \Illuminate\Support\Str::limit($book->judul, 30) }}
            </h2>

            <!-- AUTHOR -->
            <p class="text-sm text-gray-500">
                {{ $book->penulis }}
            </p>

            <!-- STOCK -->
            @if($book->stock_buku > 0)
                <p class="text-green-500 text-sm mt-1">
                    {{ $book->stock_buku }} Copies Available
                </p>
            @else
                <p class="text-red-500 text-sm mt-1">
                    Unavailable
                </p>
            @endif

            <!-- BUTTON -->
            <div class="flex gap-2 mt-4">

                <!-- DETAIL -->
                <a href="{{ route('catalog.show', $book->id) }}"
                    class="flex-1 border border-gray-300 py-2 rounded-xl text-sm hover:bg-gray-100">
                    Details
                </a>

                <!-- BORROW -->
                @if($book->stock_buku > 0)
                    <form action="{{ route('siswa.borrow.store', $book->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button class="w-full bg-[#7A2E2E] text-white py-2 rounded-xl hover:opacity-90 text-sm">
                            Borrow
                        </button>
                    </form>
                @else
                    <button class="flex-1 bg-gray-300 text-gray-500 py-2 rounded-xl text-sm cursor-not-allowed">
                        Borrow
                    </button>
                @endif

            </div>

        </div>
        @endforeach

    </div>

</div>

@endsection