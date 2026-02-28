@extends('layouts.app')

@section('content')
<h2 class="text-lg font-semibold mb-4">Tambah Kategori</h2>

<form method="POST" action="/admin/category">
    @csrf

    <input type="text" name="nama_kategori"
           placeholder="Nama Kategori"
           class="border p-2 rounded w-64">

    <button class="bg-[#64313E] text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@endsection
