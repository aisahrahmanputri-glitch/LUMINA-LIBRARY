<!DOCTYPE html>
<html>
<head>
    <title>Petugas</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <div class="w-64 bg-white min-h-screen p-5">

        <h2 class="font-bold mb-6">Petugas Panel</h2>

        <a href="{{ route('petugas.dashboard') }}" class="block py-2">🏠 Dashboard</a>
        <a href="{{ route('petugas.books.index') }}" class="block py-2">📚 Books</a>
        <a href="{{ route('petugas.categories.index') }}" class="block py-2">🏷 Category</a>
        <a href="{{ route('petugas.review.index') }}" class="block py-2">⭐ Review</a>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-6">
        @yield('content')
    </div>

</div>

</body>
</html>