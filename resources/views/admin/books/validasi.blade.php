@extends('layouts.app')

@section('content')
<div class="p-8">

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#7A2E2E]">Validasi Peminjaman</h1>
        <span class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow">
            Total: {{ count($data) }}
        </span>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 border border-[#f3d6d6]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-gray-500 text-left">
                        <th class="p-3">Buku</th>
                        <th class="p-3 text-center">Siswa</th>
                        <th class="p-3 text-center">Tanggal</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr class="border-b hover:bg-[#fff7f7] transition">

                        <td class="p-3 flex items-center gap-3">
                            <img src="{{ asset('storage/'.$item->buku->cover) }}"
                                 class="w-12 h-16 rounded-lg object-cover shadow">
                            <div>
                                <div class="font-semibold text-[#7A2E2E]">{{ $item->buku->judul }}</div>
                                <div class="text-xs text-gray-400">{{ $item->buku->penulis }}</div>
                            </div>
                        </td>

                        <td class="p-3 text-center font-medium text-gray-700">
                            {{ $item->siswa->nama ?? '-' }}
                        </td>

                        <td class="p-3 text-center text-gray-500 text-sm">
                            {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}
                        </td>

                        <td class="p-3 text-center">
                            <div class="flex justify-center gap-2">
                                <form method="POST" action="{{ route('admin.books.approve', $item->id) }}">
                                    @csrf @method('PUT')
                                    <button onclick="return confirm('Setujui peminjaman ini?')"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs transition">
                                        Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.books.reject', $item->id) }}">
                                    @csrf @method('PUT')
                                    <button onclick="return confirm('Tolak peminjaman ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs transition">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-400">
                            📭 Tidak ada peminjaman yang perlu divalidasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection