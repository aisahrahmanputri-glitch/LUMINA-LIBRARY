@extends('layouts.app')

@section('content')
<div class="p-8">

    <h1 class="text-2xl font-semibold mb-6">
        Edit Category
    </h1>

    <div class="bg-white p-6 rounded-xl shadow max-w-md">

        <form method="POST"
              action="{{ route('admin.categories.update',$category->id) }}">
            @csrf
            @method('PUT')

            <label class="block mb-2 text-sm">Category Name</label>
            <input type="text"
                   name="nama_kategori"
                   value="{{ $category->nama_kategori }}"
                   class="w-full border p-2 rounded mb-4"
                   required>

            <button class="bg-[#7A2E2E] text-white px-4 py-2 rounded">
                Update
            </button>

        </form>

    </div>
</div>
@endsection
