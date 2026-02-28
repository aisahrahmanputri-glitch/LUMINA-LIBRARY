@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <h1 class="text-3xl font-bold text-gray-700 mb-6">
        Admin Dashboard
    </h1>

    <!-- CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <p class="text-gray-400 text-sm">Total Books</p>
            <h2 class="text-3xl font-bold text-[#7A2E2E]">{{ $books }}</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <p class="text-gray-400 text-sm">Total Users</p>
            <h2 class="text-3xl font-bold text-blue-600">{{ $users }}</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <p class="text-gray-400 text-sm">Menunggu Validasi</p>
            <h2 class="text-3xl font-bold text-yellow-600">{{ $validasi }}</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <p class="text-gray-400 text-sm">Borrowed Today</p>
            <h2 class="text-3xl font-bold text-green-600">{{ $today }}</h2>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-lg mb-4">Recent Activities</h2>

            @forelse($recentBorrowings as $borrow)
                <div class="flex justify-between border-b py-2 text-sm">
                    <span>{{ $borrow->siswa->nama ?? 'User' }}</span>
                    <span class="text-gray-500">{{ $borrow->buku->judul ?? '-' }}</span>
                </div>
            @empty
                <p class="text-gray-400 text-sm">Belum ada aktivitas</p>
            @endforelse
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-lg mb-4">Most Popular Books</h2>

            @forelse($popularBooks as $book)
                <div class="flex justify-between items-center border-b py-2">
                    <span class="text-sm">{{ $book->judul }}</span>
                    <span class="text-yellow-500 text-sm">⭐ {{ $book->ulasans_count }}</span>
                </div>
            @empty
                <p class="text-gray-400 text-sm">Belum ada data</p>
            @endforelse
        </div>

    </div>

</div>

@endsection