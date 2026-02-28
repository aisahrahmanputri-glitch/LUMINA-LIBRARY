<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#7A2E2E',
          }
        }
      }
    }
    </script>
</head>

<body class="bg-gradient-to-br from-[#fff7f7] via-[#fdf2f2] to-[#ffe4e6]">

<div class="flex flex-col h-screen overflow-hidden">

    <!-- TOPBAR -->
    <div class="w-full px-6 py-3 flex justify-between items-center border-b border-[#f3d6d6] shadow-sm bg-white">

        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain scale-[1.8]">
            <span class="font-semibold text-[#7A2E2E] text-base">Lumina Library</span>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-gray-500 text-sm px-3 py-1.5 rounded-md border bg-gray-50">
                Role: <span class="text-[#7A2E2E] font-medium">{{ auth()->user()->role }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-9 h-9 rounded-lg border bg-gray-50 hover:bg-[#7A2E2E] hover:text-white transition flex items-center justify-center">
                    ⏻
                </button>
            </form>
        </div>
    </div>

    <!-- BODY -->
    <div class="flex flex-1 overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-gradient-to-b from-[#7A2E2E] to-[#5c1f1f] text-white flex flex-col justify-between">

            <div class="p-6">
                <nav class="flex flex-col gap-2 text-sm">

                    {{-- ================= PETUGAS ================= --}}
                    @if(auth()->user()->role == 'petugas')

                        <a href="{{ route('petugas.dashboard') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('petugas.dashboard') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            🏠 Dashboard
                        </a>

                        <a href="{{ route('catalog.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('catalog.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            📚 Book Catalog
                        </a>

                        <a href="{{ route('petugas.books.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('petugas.books.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            🗂 Manage Books
                        </a>

                        <a href="{{ route('petugas.categories.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('petugas.categories.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            🏷 Category Book
                        </a>

                        <a href="{{ route('petugas.borrowings.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('petugas.borrowings.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            📖 Borrowing Records
                        </a>

                        <a href="{{ route('petugas.books.validasi') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('petugas.books.validasi') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            📥 Status Validasi
                        </a>

                        <a href="{{ route('petugas.review.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('petugas.review.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            ⭐ Book Review
                        </a>

                    @endif


                    {{-- ================= ADMIN ================= --}}
                    @if(auth()->user()->role == 'admin')

                        <a href="{{ route('admin.dashboard') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            🏠 Dashboard
                        </a>

                        <a href="{{ route('catalog.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('catalog.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            📚 Book Catalog
                        </a>

                        <a href="{{ route('admin.books.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('admin.books.*') && !request()->routeIs('admin.books.validasi*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            📖 Manage Books
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('admin.categories.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            🏷 Category Book
                        </a>

                        <!-- 🔥 FIX DISINI -->
                        <a href="{{ route('admin.borrowings.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('admin.borrowings.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            📋 Borrowing Records
                        </a>

                        <a href="{{ route('admin.review.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('admin.review.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            ⭐ Book Review
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            👤 User Management
                        </a>

                        <a href="{{ route('admin.books.validasi') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('admin.books.validasi*') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            📥 Validasi Book
                        </a>

                        <a href="{{ route('admin.settings') }}"
                        class="px-4 py-3 rounded-xl {{ request()->routeIs('admin.settings') ? 'bg-white text-[#7A2E2E]' : 'hover:bg-white/20' }}">
                            ⚙ Settings
                        </a>

                    @endif

                </nav>
            </div>

            <!-- PROFILE AUTO UPDATE -->
            <div class="p-6 border-t border-white/20 flex items-center gap-3">

                <div class="w-10 h-10 rounded-full overflow-hidden">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/'.auth()->user()->avatar) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-white text-[#7A2E2E] flex items-center justify-center font-bold">
                            {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div>
                    <p class="font-semibold text-sm text-white">{{ auth()->user()->nama }}</p>
                    <p class="text-xs text-white/60">{{ auth()->user()->role }}</p>
                </div>
            </div>

        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-8 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>