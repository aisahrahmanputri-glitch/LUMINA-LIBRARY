@extends('layouts.siswa')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-[#7A2E2E] mb-6">
        Riwayat Peminjaman
    </h1>

    <div class="space-y-4">

        @forelse($data as $item)

        <div class="bg-white rounded-2xl shadow p-4 flex items-center justify-between border border-[#f3d6d6]">

            <!-- LEFT -->
            <div class="flex gap-4 items-center">

                <!-- COVER -->
                <img src="{{ asset('storage/'.$item->buku->cover) }}"
                     class="w-16 h-20 object-cover rounded-lg">

                <!-- INFO -->
                <div>
                    <h2 class="font-semibold text-lg">
                        {{ $item->buku->judul }}
                    </h2>

                    <p class="text-gray-500 text-sm">
                        {{ $item->buku->penulis }}
                    </p>

                    <div class="text-xs text-gray-400 mt-1">
                        Dipinjam: {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d/m/Y') }}
                    </div>

                    @if($item->tanggal_pengembalian)
                    <div class="text-xs text-gray-400">
                        Dikembalikan: {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d/m/Y') }}
                    </div>
                    @endif

                    <!-- BUTTON RETURN -->
                    @if($item->status_pengembalian == 'dipinjam')
                    <form method="POST" action="{{ route('siswa.return', $item->id) }}" class="mt-2">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-[#7A2E2E] text-white px-3 py-1 rounded-lg text-sm hover:opacity-90">
                            Return Book
                        </button>
                    </form>
                    @endif

                </div>
            </div>

            <!-- RIGHT STATUS -->
            <div>
                @if($item->status_pengembalian == 'menunggu')
                    <span class="bg-yellow-100 text-yellow-600 px-4 py-1 rounded-full text-sm">
                        Menunggu
                    </span>

                @elseif($item->status_pengembalian == 'dipinjam')
                    <span class="bg-gray-200 text-gray-700 px-4 py-1 rounded-full text-sm">
                        Borrowed
                    </span>

                @elseif($item->status_pengembalian == 'dikembalikan')
                    <div class="flex flex-col items-end gap-2">
                        <span class="bg-green-100 text-green-600 px-4 py-1 rounded-full text-sm">
                            Returned
                        </span>
                        <a href="{{ route('catalog.show', $item->buku->id) }}#form-review"
                           class="bg-[#7A2E2E] text-white px-3 py-1 rounded-lg text-sm hover:bg-[#5c1f1f] transition">
                            ⭐ Write Review
                        </a>
                    </div>

                @elseif($item->status_pengembalian == 'ditolak')
                    <span class="bg-red-100 text-red-600 px-4 py-1 rounded-full text-sm">
                        Ditolak
                    </span>
                @endif
            </div>

        </div>

        @empty
            <div class="text-center text-gray-400 py-10">
                Belum ada riwayat
            </div>
        @endforelse

    </div>

</div>

@endsection