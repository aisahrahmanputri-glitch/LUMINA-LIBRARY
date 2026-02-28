@extends('layouts.petugas')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-[#7A2E2E]">
            Borrowing Records
        </h1>

        <a href="{{ route('petugas.borrowings.pdf') }}"
           class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition text-sm">
            🖨 Print PDF
        </a>
    </div>

    <!-- FILTER -->
    <div class="flex gap-2 mb-6">
        <a href="{{ route('petugas.borrowings.index') }}"
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
                    <th class="p-4 text-center">Borrow Date</th>
                    <th class="p-4 text-center">Due Date</th>
                    <th class="p-4 text-center">Return Date</th>
                    <th class="p-4 text-center">Status</th>
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
                            <div class="font-semibold text-gray-700">{{ $b->buku->judul }}</div>
                            <div class="text-xs text-gray-400">{{ $b->buku->penulis }}</div>
                        </div>
                    </td>

                    <!-- USER -->
                    <td class="text-center text-gray-600">
                        {{ $b->siswa->nama }}
                    </td>

                    <!-- BORROW DATE -->
                    <td class="text-center text-gray-500">
                        {{ \Carbon\Carbon::parse($b->tanggal_peminjaman)->format('d M Y') }}
                    </td>

                    <!-- DUE DATE -->
                    <td class="text-center text-gray-500">
                        {{ \Carbon\Carbon::parse($b->tanggal_peminjaman)->addDays(7)->format('d M Y') }}
                    </td>

                    <!-- RETURN DATE -->
                    <td class="text-center text-gray-500">
                        {{ $b->tanggal_pengembalian 
                            ? \Carbon\Carbon::parse($b->tanggal_pengembalian)->format('d M Y') 
                            : '-' }}
                    </td>

                    <!-- STATUS -->
                    <td class="text-center">
                        @if($b->status_pengembalian == 'dipinjam')
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs">Active</span>
                        @elseif($b->status_pengembalian == 'terlambat')
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">Overdue</span>
                        @elseif($b->status_pengembalian == 'dikembalikan')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">Returned</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">{{ $b->status_pengembalian }}</span>
                        @endif
                    </td>

                    <!-- ACTION -->
                    <td class="text-center">
                        @if($b->status_pengembalian == 'dipinjam')
                            <form method="POST" action="{{ route('petugas.return', $b->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="border px-4 py-1 rounded-full text-sm hover:bg-gray-100">
                                    Mark Return
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center p-6 text-gray-400">No data found</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

@endsection