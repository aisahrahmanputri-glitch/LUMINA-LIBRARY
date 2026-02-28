<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $users = [
        ['id'=>1,'name'=>'Admin','email'=>'admin@mail.com','role'=>'admin'],
        ['id'=>2,'name'=>'Officer','email'=>'officer@mail.com','role'=>'officer'],
        ['id'=>3,'name'=>'Borrower','email'=>'borrower@mail.com','role'=>'borrower'],
    ];

    public function index()
    {
        return view('admin.users.index', ['users'=>$this->users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        return redirect('/admin/users')->with('success','User berhasil ditambahkan');
    }

    public function show($id)
    {
        return view('admin.users.show', ['id'=>$id]);
    }

    public function edit($id)
    {
        return view('admin.users.edit', ['id'=>$id]);
    }

    public function update(Request $request, $id)
    {
        return redirect('/admin/users')->with('success','User berhasil diupdate');
    }

    public function destroy($id)
    {
        return redirect('/admin/users')->with('success','User berhasil dihapus');
    }
}
