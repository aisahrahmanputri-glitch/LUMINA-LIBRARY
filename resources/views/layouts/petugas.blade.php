<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Petugas Panel</title>
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
    <div class="w-full bg-gradient-to-br from-[#fff7f7] via-[#fdf2f2] to-[#ffe4e6] 
    px-6 py-3 flex justify-between items-center 
    border-b border-[#f3d6d6] shadow-sm z-10 flex-shrink-0">

        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" 
                class="w-12 h-12 object-contain scale-[1.8]">

            <span class="font-semibold text-[#7A2E2E] text-base tracking-tight">
                Lumina Library
            </span>
        </div>

        <div class="flex items-center gap-3">

            <div class="text-gray-500 text-sm px-3 py-1.5 rounded-md border border-gray-200 bg-gray-50">
                Role: <span class="text-[#7A2E2E] font-medium">{{ auth()->user()->role }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-9 h-9 rounded-lg border border-gray-200 bg-gray-50
                    text-gray-500 hover:bg-[#7A2E2E] hover:text-white hover:border-[#7A2E2E]
                    transition flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm10.72 4.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H9a.75.75 0 0 1 0-1.5h10.94l-1.72-1.72a.75.75 0 0 1 0-1.06Z"/>
                    </svg>

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

                    <!-- DASHBOARD -->
                    <a href="{{ route('petugas.dashboard') }}"
                        class="px-4 py-3 rounded-xl
                        {{ request()->routeIs('petugas.dashboard') 
                        ? 'bg-white text-[#7A2E2E] font-semibold shadow-md' 
                        : 'text-white/80 hover:bg-white/20' }}">
                        Dashboard
                    </a>

                    <!-- CATALOG -->
                    <a href="{{ route('catalog.index') }}"
                        class="px-4 py-3 rounded-xl
                        {{ request()->routeIs('catalog.*') 
                        ? 'bg-white text-[#7A2E2E] font-semibold shadow-md' 
                        : 'text-white/80 hover:bg-white/20' }}">
                        Book Catalog
                    </a>

                    <!-- MANAGE BOOKS (FIX DOUBLE ACTIVE) -->
                    <a href="{{ route('petugas.books.index') }}"
                        class="px-4 py-3 rounded-xl
                        {{ request()->routeIs('petugas.books.*') && !request()->routeIs('petugas.books.validasi')
                        ? 'bg-white text-[#7A2E2E] font-semibold shadow-md' 
                        : 'text-white/80 hover:bg-white/20' }}">
                        Manage Books
                    </a>

                    <!-- CATEGORY -->
                    <a href="{{ route('petugas.categories.index') }}"
                        class="px-4 py-3 rounded-xl
                        {{ request()->routeIs('petugas.categories.*') 
                        ? 'bg-white text-[#7A2E2E] font-semibold shadow-md' 
                        : 'text-white/80 hover:bg-white/20' }}">
                        Category Book
                    </a>

                    <!-- BORROW -->
                    <a href="{{ route('petugas.borrowings.index') }}"
                        class="px-4 py-3 rounded-xl
                        {{ request()->routeIs('petugas.borrowings.*') 
                        ? 'bg-white text-[#7A2E2E] font-semibold shadow-md' 
                        : 'text-white/80 hover:bg-white/20' }}">
                        Borrowing Records
                    </a>

                    <!-- VALIDASI -->
                    <a href="{{ route('petugas.books.validasi') }}"
                        class="px-4 py-3 rounded-xl
                        {{ request()->routeIs('petugas.books.validasi') 
                        ? 'bg-white text-[#7A2E2E] font-semibold shadow-md' 
                        : 'text-white/80 hover:bg-white/20' }}">
                        Status Validasi
                    </a>

                    <!-- REVIEW -->
                    <a href="{{ route('petugas.review.index') }}"
                        class="px-4 py-3 rounded-xl
                        {{ request()->routeIs('petugas.review.*') 
                        ? 'bg-white text-[#7A2E2E] font-semibold shadow-md' 
                        : 'text-white/80 hover:bg-white/20' }}">
                        Book Review
                    </a>

                </nav>
            </div>

            <!-- USER -->
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
                    <p class="font-semibold text-sm">{{ auth()->user()->nama }}</p>
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