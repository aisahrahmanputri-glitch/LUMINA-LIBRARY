@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-[#7A2E2E]">
            Borrowing Records
        </h1>

        <a href="{{ route('admin.borrowings.pdf') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            🖨 Print PDF
        </a>
    </div>

    <!-- FILTER -->
    <div class="flex gap-2 mb-6">

        <a href="{{ route('admin.borrowings.index') }}"
           class="px-4 py-2 rounded-full border 
           {{ request('status') == '' ? 'bg-[#7A2E2E] text-white' : 'bg-gray-100 text-gray-600' }}">
            All Records
        </a>

        <a href="?status=dipinjam"
           class="px-4 py-2 rounded-full border 
           {{ request('status') == 'dipinjam' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-600' }}">
            Active
        </a>

        <a href="?status=dikembalikan"
           class="px-4 py-2 rounded-full border 
           {{ request('status') == 'dikembalikan' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-600' }}">
            Returned
        </a>

        <a href="?status=terlambat"
           class="px-4 py-2 rounded-full border 
           {{ request('status') == 'terlambat' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-600' }}">
            Overdue
        </a>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow border border-[#f3d6d6] overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-[#fff7f7] text-[#7A2E2E]">
                <tr>
                    <th class="p-4 text-left">Book</th>
                    <th class="p-4 text-center">Borrower</th>
                    <th class="p-4 text-center">Borrow Year</th>
                    <th class="p-4 text-center">Due Year</th>
                    <th class="p-4 text-center">Return Year</th>
                    <th class="p-4 text-center">Status</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($data as $b)
                <tr class="border-t border-[#f3d6d6] hover:bg-[#fff7f7] transition">

                    <!-- BOOK -->
                    <td class="p-4 flex items-center gap-3">
                        <img src="{{ asset('storage/'.$b->buku->cover) }}"
                             class="w-12 h-16 object-cover rounded">

                        <div>
                            <div class="font-semibold text-gray-700">
                                {{ $b->buku->judul }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $b->buku->penulis }}
                            </div>
                        </div>
                    </td>

                    <!-- USER -->
                    <td class="text-center text-gray-600">
                        {{ $b->siswa->nama }}
                    </td>

                    <!-- BORROW YEAR -->
                    <td class="text-center text-gray-500">
                        {{ $b->tanggal_peminjaman ? $b->tanggal_peminjaman->format('Y') : '-' }}
                    </td>

                    <!-- DUE YEAR -->
                    <td class="text-center text-gray-500">
                        {{ $b->tanggal_peminjaman ? $b->tanggal_peminjaman->copy()->addDays(7)->format('Y') : '-' }}
                    </td>

                    <!-- RETURN YEAR -->
                    <td class="text-center text-gray-500">
                        {{ $b->tanggal_pengembalian ? $b->tanggal_pengembalian->format('Y') : '-' }}
                    </td>

                    <!-- STATUS -->
                    <td class="text-center">

                        @if($b->status_pengembalian == 'dipinjam')
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs">
                                Active
                            </span>

                        @elseif($b->status_pengembalian == 'terlambat')
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">
                                Overdue
                            </span>

                        @elseif($b->status_pengembalian == 'dikembalikan')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                                Returned
                            </span>

                        @else
                            <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs">
                                {{ ucfirst($b->status_pengembalian) }}
                            </span>
                        @endif

                    </td>

                    <!-- ACTION -->
                    <td class="text-center space-x-1">

                        <!-- DELETE ONLY -->
                        <form method="POST" action="{{ route('admin.borrowings.destroy', $b->id) }}" class="inline"
                              onsubmit="return confirm('Yakin mau hapus data ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-gray-500 text-white px-3 py-1 rounded-full text-xs hover:opacity-90">
                                🗑
                            </button>
                        </form>

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center p-6 text-gray-400">
                        No data found
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection