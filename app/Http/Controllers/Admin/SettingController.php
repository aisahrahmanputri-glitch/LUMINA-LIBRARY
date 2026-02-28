<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.settings.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;

        // password optional
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // upload avatar
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        // 🔥 BIAR SIDEBAR LANGSUNG UPDATE
        Auth::setUser($user->fresh());

        return back()->with('success', 'Profile updated!');
    }
}