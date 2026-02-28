@extends('layouts.petugas')

@section('content')

<div class="p-8">

    <h1 class="text-2xl font-bold text-[#7A2E2E] mb-6">
        Book Reviews
    </h1>

    <div class="bg-white rounded-2xl shadow border border-[#f3d6d6] overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-[#fff7f7] border-b border-[#f3d6d6] text-[#7A2E2E]">
                <tr>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Book</th>
                    <th class="p-4 text-left">Review</th>
                    <th class="p-4 text-center">Rating</th>
                </tr>
            </thead>

            <tbody>

                @forelse($ulasans as $u)
                <tr class="border-b border-[#f3d6d6] hover:bg-[#fff7f7] transition">

                    <!-- USER -->
                    <td class="p-4 font-medium text-gray-700">
                        {{ $u->user->nama }}
                    </td>

                    <!-- BOOK -->
                    <td class="p-4 text-gray-600">
                        {{ $u->buku->judul }}
                    </td>

                    <!-- REVIEW -->
                    <td class="p-4 text-gray-500">
                        {{ $u->komentar }}
                    </td>

                    <!-- RATING -->
                    <td class="p-4 text-center text-yellow-500 font-semibold">
                        ⭐ {{ $u->rating }}
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-400">
                        Belum ada review
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection