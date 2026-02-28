@extends('layouts.siswa')

@section('content')

<div class="space-y-6">

    <h1 class="text-2xl font-bold text-[#7A2E2E]">
        ⏳ Menunggu Validasi
    </h1>

    <div class="bg-white rounded-2xl shadow p-6 border border-[#f3d6d6]">

        <table class="w-full text-sm">

            <thead class="border-b text-gray-500">
                <tr>
                    <th>#</th>
                    <th>Buku</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $i => $b)
                <tr class="border-b hover:bg-gray-50">

                    <td class="py-3">{{ $i+1 }}</td>

                    <!-- BOOK -->
                    <td class="flex items-center gap-3 py-3">
                        <img src="{{ asset('storage/'.$b->buku->cover) }}"
                             class="w-10 h-14 object-cover rounded">

                        <div>
                            <div class="font-medium">
                                {{ $b->buku->judul }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $b->buku->penulis }}
                            </div>
                        </div>
                    </td>

                    <td>{{ $b->tanggal_peminjaman }}</td>

                    <td>
                        <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">
                            Menunggu
                        </span>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-400">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection