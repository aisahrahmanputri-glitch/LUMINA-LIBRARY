@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-3 gap-6">
    <div>
        <img src="{{ $book['cover'] }}" class="rounded-xl shadow w-full">
    </div>

    <div class="md:col-span-2 bg-white p-5 rounded-xl shadow">
        <h2 class="text-xl font-bold text-[#64313E]">{{ $book['title'] }}</h2>
        <p class="text-sm text-gray-500 mb-2">{{ $book['author'] }}</p>
        <p class="text-yellow-500 text-sm mb-4">⭐ {{ $book['rating'] }}</p>

        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
            <div class="border rounded-lg p-2">ISBN<br><b>{{ $book['isbn'] ?? '-' }}</b></div>
            <div class="border rounded-lg p-2">Tahun Terbit<br><b>{{ $book['year'] ?? '-' }}</b></div>
            <div class="border rounded-lg p-2">Total Copies<br><b>{{ $book['copies'] ?? '-' }}</b></div>
            <div class="border rounded-lg p-2">Penerbit<br><b>{{ $book['publisher'] ?? '-' }}</b></div>
        </div>

        <h4 class="font-semibold mb-1">Description</h4>
        <p class="text-sm text-gray-600">{{ $book['description'] ?? '-' }}</p>
    </div>
</div>
@endsection
