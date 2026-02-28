@extends('layouts.app')

@section('content')
<div class="p-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">
            Category Book
        </h1>

        <button onclick="openModal()"
            class="bg-[#7A2E2E] text-white px-5 py-2 rounded-lg shadow hover:opacity-90">
            + Add Categories
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm">
            <thead class="border-b text-gray-500 bg-gray-50">
                <tr>
                    <th class="text-left p-4">Categories</th>
                    <th class="text-center p-4">Total Book</th>
                    <th class="text-center p-4">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $c)
                <tr class="border-b hover:bg-gray-50">

                    <!-- NAMA -->
                    <td class="p-4 font-medium">
                        {{ $c->nama_kategori }}
                    </td>

                    <!-- TOTAL -->
                    <td class="p-4 text-center">
                        {{ $c->bukus_count }} book
                    </td>

                    <!-- ACTION -->
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-4">

                            <!-- EDIT -->
                            <a href="{{ route('admin.categories.edit',$c->id) }}"
                               class="text-blue-500 hover:scale-110 transition">
                                ✏️
                            </a>

                            <!-- DELETE -->
                            <form method="POST"
                                  action="{{ route('admin.categories.destroy',$c->id) }}"
                                  onsubmit="event.preventDefault(); confirmDelete(this);">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-500 hover:scale-110 transition">
                                    🗑
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

{{-- MODAL ADD --}}
<div id="modalKategori"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center">

    <div class="bg-white p-6 rounded-xl w-[400px]">

        <h3 class="text-lg font-semibold mb-4">
            Tambah Kategori
        </h3>

        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <input name="nama_kategori"
                   placeholder="Nama kategori"
                   class="w-full border p-2 rounded mb-4"
                   required>

            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="closeModal()"
                        class="px-4 py-2 border rounded">
                    Batal
                </button>

                <button class="bg-[#7A2E2E] text-white px-5 py-2 rounded">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// MODAL
function openModal(){
    document.getElementById('modalKategori').classList.remove('hidden');
    document.getElementById('modalKategori').classList.add('flex');
}

function closeModal(){
    document.getElementById('modalKategori').classList.add('hidden');
}

// DELETE CONFIRM
function confirmDelete(form){
    if(confirm("Yakin mau hapus kategori ini?")){
        form.submit();
    }
}
</script>

@endsection