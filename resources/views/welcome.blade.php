<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumina Library</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#fdf6f6] font-sans">

    <!-- NAVBAR -->
    <nav class="flex items-center justify-between px-8 py-4 bg-white shadow-sm">
        <div class="flex items-center gap-2">
            <span class="text-xl">📚</span>
            <span class="font-bold text-[#7A2E2E]">Lumina Library</span>
        </div>
        <a href="{{ route('login') }}"
           class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
            Login
        </a>
    </nav>

    <!-- HERO -->
    <section class="px-8 py-16 max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10">
        <div class="flex-1">
            <h1 class="text-4xl font-bold text-[#7A2E2E] leading-tight mb-4">
                Welcome To<br>Lumina Library
            </h1>
            <p class="text-gray-500 mb-8 max-w-md">
                Eksplorasi ribuan buku pilihan secara digital, reservasi sekarang, dan nikmati kemudahan ambil-balikin buku langsung di perpus sekolah secara sat-set!
            </p>
            <a href="{{ route('login') }}"
               class="inline-block bg-[#7A2E2E] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#5e2323] transition">
                Mulai Sekarang
            </a>
        </div>
        <div class="flex-1 flex justify-center">
            <img src="{{ asset('images/baca.png') }}"
                 class="w-80 h-64 object-contain drop-shadow-lg">
        </div>
    </section>

    <!-- ABOUT US -->
    <section class="px-8 py-12 max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow p-8 flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">About Us</h2>
                <p class="text-gray-500 leading-relaxed">
                    Lumina Library berfokus pada pengelolaan data peminjaman buku untuk siswa dengan sistem yang praktis, cepat, dan rapi, sehingga membantu petugas perpustakaan dalam memberikan layanan yang lebih nyaman dan efisien 📚✨
                </p>
            </div>
            <div class="flex-1 flex justify-center">
                <img src="{{ asset('images/baca.png') }}"
                     class="w-56 h-44 object-contain drop-shadow-md">
            </div>
        </div>
    </section>

    <!-- BEST SELLER -->
    <section class="px-8 py-12 max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-[#7A2E2E] text-center mb-8">Best Seller</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @forelse($bestSellers as $book)
            <div class="bg-white rounded-xl shadow p-3 text-center hover:shadow-md transition">
                @if($book->cover)
                    <img src="{{ asset('storage/'.$book->cover) }}"
                         class="w-full h-36 object-cover rounded-lg mb-3">
                @else
                    <div class="w-full h-36 bg-[#f3d6d6] rounded-lg mb-3 flex items-center justify-center text-4xl">📖</div>
                @endif
                <p class="text-xs text-gray-400 mb-1">{{ $book->kategori->nama_kategori ?? '-' }}</p>
                <p class="text-sm font-semibold text-gray-700 truncate">{{ $book->judul }}</p>
                <span class="text-xs mt-1 inline-block px-2 py-0.5 rounded-full
                    {{ $book->stock_buku > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-500' }}">
                    {{ $book->stock_buku > 0 ? 'Available' : 'Unavailable' }}
                </span>
            </div>
            @empty
            <div class="col-span-6 text-center text-gray-400 py-10">Belum ada buku</div>
            @endforelse
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center py-8 text-sm text-gray-400 border-t border-gray-100 mt-4">
        © {{ date('Y') }} Lumina Library. All rights reserved.
    </footer>

</body>
</html>