@extends('layouts.siswa')

@section('content')

<div class="p-8">

    <!-- ALERT -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- BOOK DETAIL -->
    <div class="bg-white p-6 rounded-2xl shadow grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 border border-[#f3d6d6]">

        <!-- COVER -->
        <div>
            <img src="{{ asset('storage/'.$book->cover) }}"
                 class="rounded-xl w-full h-[350px] object-cover">
        </div>

        <!-- DETAIL -->
        <div>

            <span class="text-xs bg-[#fff7f7] text-[#7A2E2E] border border-[#f3d6d6] px-3 py-1 rounded-full">
                {{ $book->kategori->nama_kategori ?? '-' }}
            </span>

            <h1 class="text-2xl font-bold text-[#7A2E2E] mt-2">
                {{ $book->judul }}
            </h1>

            <p class="text-gray-500">{{ $book->penulis }}</p>

            <p class="mt-2 text-yellow-500">
                ⭐ {{ $book->average_rating ?? 0 }} Rating
            </p>

            <div class="grid grid-cols-2 gap-3 mt-4 text-sm">
                <div class="border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded-lg">
                    ISBN: {{ $book->isbn }}
                </div>
                <div class="border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded-lg">
                    Tahun: {{ $book->tahun_terbit }}
                </div>
                <div class="border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded-lg">
                    Stock: {{ $book->stock_buku }}
                </div>
                <div class="border border-[#f3d6d6] bg-[#fff7f7] p-2 rounded-lg">
                    Penerbit: {{ $book->penerbit }}
                </div>
            </div>

            <h3 class="mt-4 font-semibold text-[#7A2E2E]">Description</h3>
            <p class="text-gray-600 text-sm mt-2">{{ $book->sinopsis }}</p>

            <!-- BUTTON PINJAM -->
            @if($book->stock_buku > 0)
                <form action="{{ url('/siswa/borrow/'.$book->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit"
                        class="w-full bg-[#7A2E2E] hover:bg-[#5c1f1f] text-white px-6 py-3 rounded-xl transition">
                        📖 Borrow This Book
                    </button>
                </form>
            @else
                <button class="w-full bg-gray-300 text-gray-500 px-6 py-3 rounded-xl mt-4 cursor-not-allowed">
                    Stok Habis
                </button>
            @endif

        </div>
    </div>

    <!-- REVIEWS -->
    <div class="bg-white p-6 rounded-2xl shadow mb-6 border border-[#f3d6d6]">

        <h2 class="font-semibold text-[#7A2E2E] mb-4">Reviews</h2>

        @forelse($book->ulasans as $r)
            <div class="border-b border-[#f3d6d6] py-3">
                <p class="text-sm font-semibold text-[#1f2937]">{{ $r->user->nama ?? 'User' }}</p>
                <p class="text-yellow-500">⭐ {{ $r->rating }}</p>
                <p class="text-gray-600 text-sm">{{ $r->ulasan }}</p>
            </div>
        @empty
            <p class="text-gray-400">Belum ada review</p>
        @endforelse

    </div>

    <!-- FORM REVIEW -->
    <div id="form-review" class="bg-white p-6 rounded-2xl shadow border border-[#f3d6d6]">

        <h2 class="font-semibold text-[#7A2E2E] mb-3">Tulis Review</h2>

        <form action="{{ route('siswa.review.store', $book->id) }}" method="POST">
            @csrf

            <!-- BINTANG -->
            <div class="flex gap-2 text-3xl mb-3 cursor-pointer" id="rating-stars">
                <span data-value="1" class="text-gray-300">☆</span>
                <span data-value="2" class="text-gray-300">☆</span>
                <span data-value="3" class="text-gray-300">☆</span>
                <span data-value="4" class="text-gray-300">☆</span>
                <span data-value="5" class="text-gray-300">☆</span>
            </div>

            <input type="hidden" name="rating" id="rating-value" required>

            <textarea name="ulasan"
                class="w-full border border-[#f3d6d6] bg-[#fff7f7] p-3 rounded-xl mb-3 text-sm"
                placeholder="Tulis review kamu..." required></textarea>

            <button type="submit" class="bg-[#7A2E2E] hover:bg-[#5c1f1f] text-white px-5 py-2 rounded-xl transition">
                Kirim Review
            </button>
        </form>

    </div>

</div>

<!-- SCRIPT RATING -->
<script>
const stars = document.querySelectorAll('#rating-stars span');
const ratingInput = document.getElementById('rating-value');

stars.forEach(star => {
    star.addEventListener('click', function () {
        let value = this.getAttribute('data-value');
        ratingInput.value = value;

        stars.forEach(s => {
            s.textContent = '☆';
            s.classList.remove('text-yellow-400');
            s.classList.add('text-gray-300');
        });

        for (let i = 0; i < value; i++) {
            stars[i].textContent = '★';
            stars[i].classList.add('text-yellow-400');
        }
    });
});
</script>

@endsection