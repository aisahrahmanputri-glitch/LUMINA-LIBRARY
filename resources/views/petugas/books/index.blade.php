@extends('layouts.petugas')

@section('content')
<div class="p-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">
            Manage Books
        </h1>

        <a href="{{ route('petugas.books.create') }}"
           class="bg-[#7A2E2E] text-white px-5 py-2 rounded-xl shadow">
            + Add Book
        </a>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow p-4">

        <div class="overflow-x-auto">

            <table class="w-full text-sm border-separate border-spacing-y-3">

                <!-- HEAD -->
                <thead>
                    <tr class="bg-gray-50 text-gray-600">
                        <th class="py-4 text-left px-4">Book</th>
                        <th class="text-center px-4">Author</th>
                        <th class="text-center px-4">Publisher</th>
                        <th class="text-center px-4">Year</th>
                        <th class="text-center px-4">ISBN</th>
                        <th class="text-center px-4">Category</th>
                        <th class="text-center px-4">Stock</th>
                        <th class="text-center px-4">Actions</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>
                    @foreach($books as $book)
                    <tr class="bg-white shadow rounded-xl hover:bg-gray-50 transition">

                        <!-- BOOK (LEFT) -->
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-4">

                                <img src="{{ asset('storage/'.$book->cover) }}"
                                     class="w-14 h-20 object-cover rounded-md">

                                <div>
                                    <div class="font-semibold text-[#7A2E2E] text-sm">
                                        {{ $book->judul }}
                                    </div>

                                    <div class="text-xs text-gray-400">
                                        {{ $book->kategori->nama_kategori ?? '-' }}
                                    </div>
                                </div>

                            </div>
                        </td>

                        <!-- AUTHOR -->
                        <td class="text-center px-4">
                            {{ $book->penulis }}
                        </td>

                        <!-- PUBLISHER -->
                        <td class="text-center px-4">
                            {{ $book->penerbit }}
                        </td>

                        <!-- YEAR -->
                        <td class="text-center px-4">
                            {{ $book->tahun_terbit }}
                        </td>

                        <!-- ISBN -->
                        <td class="text-center text-xs text-gray-500 px-4">
                            {{ $book->isbn }}
                        </td>

                        <!-- CATEGORY -->
                        <td class="text-center px-4">
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">
                                {{ $book->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>

                        <!-- STOCK -->
                        <td class="text-center px-4">
                            @if($book->stock_buku > 0)
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                                    {{ $book->stock_buku }}
                                </span>
                            @else
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">
                                    0
                                </span>
                            @endif
                        </td>

                        <!-- ACTION -->
                        <td class="text-center px-4">
                            <div class="flex justify-center gap-4">

                                <a href="{{ route('petugas.books.edit',$book->id) }}"
                                   class="text-blue-500 hover:scale-110 transition">
                                    ✏️
                                </a>

                                <form method="POST"
                                      action="{{ route('petugas.books.destroy',$book->id) }}"
                                      onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500 hover:scale-110 transition">
                                        🗑
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection