@extends('layouts.app')

@section('content')

<div class="grid md:grid-cols-3 gap-6">

    <!-- COVER -->
    <div>
        <img src="{{ asset('storage/'.$book->cover) }}"
             class="rounded-xl shadow w-full">
    </div>

    <!-- DETAIL -->
    <div class="md:col-span-2 bg-white p-6 rounded-xl shadow">

        <h2 class="text-2xl font-bold text-[#64313E]">
            {{ $book->judul }}
        </h2>

        <p class="text-gray-500 mb-2">
            {{ $book->penulis }}
        </p>

        <p class="text-yellow-500 mb-4">
            ⭐ {{ $book->average_rating ?? 0 }}
        </p>

        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
            <div class="border rounded-lg p-2">
                ISBN<br><b>{{ $book->isbn }}</b>
            </div>

            <div class="border rounded-lg p-2">
                Tahun Terbit<br><b>{{ $book->tahun_terbit }}</b>
            </div>

            <div class="border rounded-lg p-2">
                Total Copies<br><b>{{ $book->stock_buku }}</b>
            </div>

            <div class="border rounded-lg p-2">
                Penerbit<br><b>{{ $book->penerbit }}</b>
            </div>
        </div>

        <h4 class="font-semibold mb-1">Description</h4>
        <p class="text-sm text-gray-600">
            {{ $book->sinopsis }}
        </p>

    </div>
</div>


<!-- KOMENTAR -->
<div class="mt-8 bg-white p-6 rounded-xl shadow">

    <h3 class="font-semibold mb-4">Komentar Pengguna</h3>

    @forelse($book->ulasans as $ulasan)
        <div class="border-b py-3">
            <div class="flex justify-between">
                <b>{{ $ulasan->user->nama ?? 'User' }}</b>
                <span class="text-yellow-500">
                    ⭐ {{ $ulasan->rating }}
                </span>
            </div>

            <p class="text-sm text-gray-600">
                {{ $ulasan->komentar }}
            </p>
        </div>
    @empty
        <p class="text-gray-400 text-sm">
            Belum ada komentar.
        </p>
    @endforelse

</div>

@endsection
