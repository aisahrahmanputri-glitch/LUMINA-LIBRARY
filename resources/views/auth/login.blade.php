<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Lumina Library</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#fdf6f6] font-sans min-h-screen flex items-center justify-center">

<div class="w-full max-w-md mx-auto px-6">

    <!-- LOGO -->
    <div class="text-center mb-8">
        <span class="text-4xl"></span>
        <h1 class="text-2xl font-bold text-[#7A2E2E] mt-2">Lumina Library</h1>
        <p class="text-gray-400 text-sm mt-1">Masuk ke akun kamu</p>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow p-8">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#7A2E2E] @error('password') border-red-400 @enderror"
                       placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full bg-[#7A2E2E] text-white py-3 rounded-xl font-semibold hover:bg-[#5e2323] transition">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-[#7A2E2E] font-semibold hover:underline">Daftar sekarang</a>
        </p>

    </div>

    <p class="text-center text-xs text-gray-300 mt-6">© {{ date('Y') }} Lumina Library</p>

</div>

</body>
</html>