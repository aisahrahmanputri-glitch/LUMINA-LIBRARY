@extends('layouts.app')

@section('content')
<div class="p-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">
            User Management
        </h1>

        <button onclick="openModal()"
            class="bg-[#7A2E2E] text-white px-5 py-2 rounded-lg shadow hover:opacity-90">
            + Add User
        </button>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="overflow-x-auto">

            <table class="w-full text-sm">
                <thead class="border-b text-gray-500">
                    <tr>
                        <th class="text-left py-3">User</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Role</th>
                        <th class="text-left">Member Since</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="py-3 font-medium">
                            {{ $user->nama }}
                        </td>

                        <td>{{ $user->email }}</td>

                        <td>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td>
                            {{ $user->created_at->format('M d, Y') }}
                        </td>

                        <!-- ACTION -->
                        <td class="text-center">
                            <form method="POST"
                                action="{{ route('admin.users.destroy',$user->id) }}"
                                onsubmit="event.preventDefault(); confirmDelete(this);">
                            @csrf
                            @method('DELETE')

                                <button class="text-red-500 hover:text-red-700 text-lg">
                                    🗑
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@include('admin.user_management.modal')

<script>
function openModal(){
    const modal = document.getElementById('modalUser');
    const box = document.getElementById('modalBox');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(()=>{
        box.classList.remove('scale-95','opacity-0');
        box.classList.add('scale-100','opacity-100');
    },50);
}

function closeModal(){
    const modal = document.getElementById('modalUser');
    const box = document.getElementById('modalBox');

    box.classList.add('scale-95','opacity-0');

    setTimeout(()=>{
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    },200);
}

function confirmDelete(form){
    if(confirm("Delete user data?")){
        form.submit();
    }
}
</script>

@endsection
