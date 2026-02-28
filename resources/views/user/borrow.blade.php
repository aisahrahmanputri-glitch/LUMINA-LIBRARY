@extends('layouts.siswa')

<!DOCTYPE html>
<html>
<head>
    <title>Book Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#dbe3ec] p-10">

<h1 class="text-3xl font-bold mb-6">Book Catalog</h1>

<!-- SEARCH -->
<form method="GET" class="flex gap-4 mb-6">

    <input type="text" name="search" placeholder="Cari buku..."
        class="border p-2 rounded w-1/3">

    <select name="kategori" class="border p-2 rounded">
        <option value="">Semua Kategori</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Misteri">Misteri</option>
    </select>

    <button class="bg-blue-500 text-white px-4 rounded">Search</button>

</form>

<!-- BOOK LIST -->
<div class="grid grid-cols-3 gap-6">

@foreach($books as $book)
<div class="bg-white p-4 rounded shadow">

    <img src="{{ $book->cover ?? 'https://via.placeholder.com/150x220' }}"
         class="h-52 w-full object-cover mb-3 rounded">

    <h3 class="font-bold">{{ $book->judul }}</h3>
    <p class="text-sm text-gray-500">{{ $book->kategori }}</p>

    <form action="{{ route('siswa.borrow.store', $book->id) }}" method="POST">
        @csrf
        <button class="mt-3 bg-green-500 text-white px-3 py-1 rounded">
            Pinjam
        </button>
    </form>

</div>
@endforeach

</div>

</body>
</html>