<div id="modalKategori"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center">

    <div class="bg-white p-6 rounded-xl w-[400px] shadow-lg">

        <h3 class="text-lg font-semibold mb-4 text-[#7A2E2E]">
            Add Category
        </h3>

        <form method="POST" action="{{ route('petugas.categories.store') }}">
            @csrf

            <!-- Nama kategori -->
            <div class="mb-3">
                <label class="text-sm text-gray-600">Category Name</label>
                <input
                    name="nama_kategori"
                    class="w-full bg-[#7A2E2E] text-white p-2 rounded"
                    required>
            </div>

            <!-- Total buku -->
            <div class="mb-4">
                <label class="text-sm text-gray-600">Total Books</label>
                <input
                    type="number"
                    name="total_buku"
                    class="w-full bg-[#7A2E2E] text-white p-2 rounded"
                    required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="closeModal()"
                        class="px-4 py-2 border rounded">
                    Cancel
                </button>

                <button class="bg-[#7A2E2E] text-white px-5 py-2 rounded">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</div>
