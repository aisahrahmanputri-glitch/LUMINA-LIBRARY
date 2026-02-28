<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // ✅ WAJIB ADA (INI YANG ERROR TADI)
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user_management.index', compact('users'));
    }

    // ✅ STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        User::destroy($id);

        return back()->with('success', 'User berhasil dihapus');
    }
}