@extends('layouts.siswa')

@section('content')

<div class="p-8 min-h-screen">

    <!-- TITLE -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-[#7A2E2E]">
            Dashboard
        </h1>
    </div>

    <!-- WELCOME -->
    <h2 class="text-xl mb-6 text-gray-700">
        Welcome Back, <span class="font-semibold text-[#7A2E2E]">{{ auth()->user()->nama }}</span> 👋
    </h2>

    <!-- STAT -->
    <div class="grid grid-cols-3 gap-6 mb-10">

        <div class="bg-white p-6 rounded-2xl shadow border border-[#f3d6d6] text-center">
            <h3 class="text-sm text-gray-500">Borrowed</h3>
            <p class="text-3xl font-bold text-[#7A2E2E] mt-2">{{ $borrowed }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border border-[#f3d6d6] text-center">
            <h3 class="text-sm text-gray-500">Returned</h3>
            <p class="text-3xl font-bold text-[#7A2E2E] mt-2">{{ $returned }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border border-[#f3d6d6] text-center">
            <h3 class="text-sm text-gray-500">Overdue</h3>
            <p class="text-3xl font-bold text-[#7A2E2E] mt-2">{{ $overdue }}</p>
        </div>

    </div>

    <!-- BEST SELLER -->
    <h2 class="text-2xl font-bold text-[#7A2E2E] mb-6">
        ⭐ Best Seller Books
    </h2>

    <div class="grid grid-cols-3 gap-6">

        @foreach($bestSeller as $item)
        <a href="{{ route('catalog.show', $item->buku->id) }}"
           class="bg-white p-5 rounded-2xl shadow border border-[#f3d6d6] text-center hover:shadow-md hover:border-[#7A2E2E] hover:-translate-y-1 transition duration-200 block">

            <img src="{{ $item->buku->cover ? asset('storage/'.$item->buku->cover) : 'https://via.placeholder.com/150' }}"
                 class="mx-auto mb-4 rounded-lg h-52 w-full object-cover">

            <h3 class="font-semibold text-[#7A2E2E]">
                {{ $item->buku->judul }}
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Dipinjam {{ $item->total }}x
            </p>

        </a>
        @endforeach

    </div>

</div>

@endsection