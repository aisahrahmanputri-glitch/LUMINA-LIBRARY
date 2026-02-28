<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Lumina Library</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#fdf6f6] font-sans min-h-screen flex items-center justify-center">

<div class="w-full max-w-md mx-auto px-6">

    <!-- LOGO -->
    <div class="text-center mb-8">
        <span class="text-4xl"></span>
        <h1 class="text-2xl font-bold text-[#7A2E2E] mt-2">Lumina Library</h1>
        <p class="text-gray-400 text-sm mt-1">Buat akun baru</p>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow p-8">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NAMA -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#7A2E2E] @error('nama') border-red-400 @enderror"
                       placeholder="Nama kamu">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#7A2E2E] @error('email') border-red-400 @enderror"
                       placeholder="email@example.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#7A2E2E] @error('password') border-red-400 @enderror"
                       placeholder="Min. 6 karakter">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#7A2E2E]"
                       placeholder="Ulangi password">
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full bg-[#7A2E2E] text-white py-3 rounded-xl font-semibold hover:bg-[#5e2323] transition">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-[#7A2E2E] font-semibold hover:underline">Login di sini</a>
        </p>

    </div>

    <p class="text-center text-xs text-gray-300 mt-6">© {{ date('Y') }} Lumina Library</p>

</div>

</body>
</html>