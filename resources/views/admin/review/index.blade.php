@extends('layouts.app')

@section('content')

<div class="p-8 min-h-screen">

    <h1 class="text-2xl font-semibold mb-6 text-[#7A2E2E]">
        Book Reviews
    </h1>

    <div class="bg-white rounded-2xl shadow border border-[#f3d6d6] overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-[#fde8e8] border-b text-[#7A2E2E]">
                <tr>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Book</th>
                    <th class="p-4 text-left">Review</th>
                    <th class="p-4 text-left">Rating</th>
                </tr>
            </thead>

            <tbody>

                @forelse($ulasans as $u)
                <tr class="border-b hover:bg-[#fff1f2] transition">

                    <td class="p-4">
                        {{ $u->user->nama }}
                    </td>

                    <td class="p-4">
                        {{ $u->buku->judul }}
                    </td>

                    <td class="p-4">
                        {{ $u->komentar }}
                    </td>

                    <td class="p-4">
                        ⭐ {{ $u->rating }}
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4 text-gray-400">
                        No reviews yet
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection