@extends('layouts.app')

@section('content')
<div class="p-8">

<h1 class="text-2xl font-bold mb-6">Dashboard Siswa</h1>

@if($lateCount > 0)
<div class="bg-red-100 text-red-700 p-3 rounded mb-4">
    Ada {{ $lateCount }} buku terlambat!
</div>
@endif

<div class="bg-white rounded-xl shadow p-6">
<table class="w-full">
<tr class="border-b">
<th>Buku</th>
<th>Tanggal Pinjam</th>
<th>Status</th>
<th>Aksi</th>
</tr>

@foreach($borrowings as $b)
<tr class="border-b text-center">
<td>{{ $b->buku->judul }}</td>
<td>{{ $b->tanggal_pinjam }}</td>
<td>{{ $b->status_pengembalian }}</td>
<td>
@if($b->status_pengembalian!='kembali')
<form method="POST" action="{{ route('siswa.return',$b->id) }}">
@csrf
@method('PUT')
<button class="bg-green-500 text-white px-3 py-1 rounded">
Kembalikan
</button>
</form>
@endif
</td>
</tr>
@endforeach
</table>
</div>

</div>
@endsection
