<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // TAMPIL PROFILE
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // UPDATE PROFILE + FOTO
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // upload foto
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile berhasil diupdate');
    }

    // GANTI PASSWORD
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }
}