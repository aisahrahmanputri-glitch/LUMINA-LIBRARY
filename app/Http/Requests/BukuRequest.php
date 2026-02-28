<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required',
            'penulis' => 'required',
            'isbn' => 'required',
            // 🔥 FIX DI SINI (hapus ; jadi ,)
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:'.date('Y'),
            'penerbit' => 'required',
            'stock_buku' => 'required|integer|min:0',
            'kategori_id' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sinopsis' => 'nullable'
        ];
    }
}