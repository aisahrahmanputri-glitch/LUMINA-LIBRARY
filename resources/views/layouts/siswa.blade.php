<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Siswa Panel</title>
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
    <div class="w-full px-6 py-3 flex justify-between items-center 
    border-b border-[#f3d6d6] shadow-sm bg-transparent">

        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" class="w-10">
            <span class="font-semibold text-[#7A2E2E]">Lumina Library</span>
        </div>

        <div class="flex items-center gap-3">

            <div class="text-gray-500 text-sm px-3 py-1 rounded border bg-white">
                Role: <span class="text-[#7A2E2E] font-medium">{{ auth()->user()->role }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-9 h-9 rounded-lg border bg-white text-gray-500
                hover:bg-[#7A2E2E] hover:text-white transition">
                    🚪
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

                    <a href="{{ route('siswa.dashboard') }}"
                    class="menu {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('catalog.index') }}"
                    class="menu {{ request()->routeIs('catalog.*') ? 'active' : '' }}">
                        Book Catalog
                    </a>

                    <a href="{{ route('siswa.history') }}"
                    class="menu {{ request()->routeIs('siswa.history') ? 'active' : '' }}">
                        My Borrowing
                    </a>

                    <a href="{{ route('siswa.ulasans') }}"
                    class="menu {{ request()->routeIs('siswa.ulasans') ? 'active' : '' }}">
                        My Review
                    </a>

                    <a href="{{ route('siswa.profile') }}"
                    class="menu {{ request()->routeIs('siswa.profile') ? 'active' : '' }}">
                        Profile
                    </a>

                </nav>

            </div>

            <!-- USER -->
            <div class="p-6 border-t border-white/20 flex items-center gap-3">

                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}"
                         class="w-10 h-10 rounded-full object-cover">
                @else
                    <div class="w-10 h-10 bg-white text-[#7A2E2E] rounded-full flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                    </div>
                @endif

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

<style>
.menu {
    padding: 12px 16px;
    border-radius: 12px;
    color: rgba(255,255,255,0.8);
    transition: 0.2s;
}

.menu:hover {
    background: rgba(255,255,255,0.2);
    color: white;
}

.menu.active {
    background: white;
    color: #7A2E2E;
    font-weight: 600;
}
</style>

</body>
</html>