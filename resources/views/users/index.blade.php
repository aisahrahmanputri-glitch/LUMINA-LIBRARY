@extends('layouts.admin')

@section('title','Manage Users')

@section('content')
<h1 class="page-title">Users</h1>

<a href="/admin/users/create" class="btn-primary">+ Add User</a>

<div class="table-card">
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td class="actions">
            <a href="/admin/users/{{ $user->id }}/edit" class="btn-secondary">Edit</a>
            <form action="/admin/users/{{ $user->id }}" method="POST">
                @csrf @method('DELETE')
                <button class="btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection
