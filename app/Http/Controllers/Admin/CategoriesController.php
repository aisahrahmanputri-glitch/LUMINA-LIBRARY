<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::withCount('bukus')->latest();

        // 🔍 FILTER SEARCH
        if ($request->search) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $categories = $query->get();

        return view('admin.Categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return back()->with('success','Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Kategori::findOrFail($id);
        return view('admin.Categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $category = Kategori::findOrFail($id);

        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return back();
    }
}