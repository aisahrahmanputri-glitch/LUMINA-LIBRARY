<aside class="w-64 bg-white p-6 shadow-md flex flex-col justify-between">

    <div>
        <div class="flex items-center gap-2 mb-8">
            <span class="text-2xl">📚</span>
            <h1 class="font-semibold text-[#7A2E2E]">
                Lumina Admin
            </h1>
        </div>

        <nav class="flex flex-col gap-2 text-sm">

            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded hover:bg-gray-100">
                🏠 Dashboard
            </a>

            <a href="{{ route('catalog.index') }}">
                📚 Book Catalog
            </a>

            <a href="{{ route('admin.books.index') }}" class="px-4 py-2 rounded hover:bg-gray-100">
                📖 Manage Books
            </a>

            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 rounded hover:bg-gray-100">
                🏷 Category Book
            </a>

            <a href="{{ route('admin.borrowings') }}" class="px-4 py-2 rounded hover:bg-gray-100">
                📋 Borrowing Records
            </a>

            <a href="{{ route('admin.review.index') }}" class="px-4 py-2 rounded hover:bg-gray-100">
                ⭐ Book Review
            </a>

            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded hover:bg-gray-100">
                👤 User Management
            </a>

            <a href="{{ route('admin.validasi.index') }}" class="px-4 py-2 rounded hover:bg-gray-100">
                Validasi Book
            </a>

            <a href="{{ route('admin.settings') }}" class="px-4 py-2 rounded hover:bg-gray-100">
                ⚙ Settings
            </a>

        </nav>
    </div>

</aside>