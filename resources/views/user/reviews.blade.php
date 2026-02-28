@section('content')

@extends('layouts.siswa')
<!-- MAIN -->
<main class="flex-1 p-6">

    <h1 class="text-2xl font-semibold text-[#6b2c2c] mb-6">
        My Reviews
    </h1>

    <div class="bg-white p-6 rounded-xl shadow">

        @forelse($reviews as $review)
        <div class="border-b py-4 flex gap-4 items-center">

            <!-- COVER -->
            <div class="w-16 h-20 bg-gray-300 rounded-lg overflow-hidden">
                @if($review->buku && $review->buku->cover)
                    <img src="{{ asset('storage/'.$review->buku->cover) }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full">
                        📚
                    </div>
                @endif
            </div>

            <!-- INFO -->
            <div class="flex-1">
                <p class="font-semibold text-[#6b2c2c]">
                    {{ $review->buku->judul ?? '-' }}
                </p>

                <p class="text-yellow-500 text-sm">
                    ⭐ {{ $review->rating ?? '-' }}
                </p>

                <p class="text-gray-600 text-sm mt-1">
                    {{ $review->ulasan ?? '-' }}
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    {{ $review->created_at->format('d M Y') }}
                </p>
            </div>

        </div>
        @empty
        <p class="text-gray-500 text-center">
            Belum ada ulasan
        </p>
        @endforelse

    </div>

</main>
@endsection