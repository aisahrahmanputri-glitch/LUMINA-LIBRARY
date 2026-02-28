@extends('layouts.siswa')

@section('content')
<div class="p-8">

    <div class="grid grid-cols-3 gap-8">

        <!-- PROFILE CARD -->
        <div class="bg-white rounded-xl shadow p-6 text-center">

            <div class="w-24 h-24 mx-auto rounded-full overflow-hidden mb-4">
                @if($user->avatar)
                    <img src="{{ asset('storage/'.$user->avatar) }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-[#7A2E2E] flex items-center justify-center text-white text-3xl">
                        {{ strtoupper(substr($user->nama,0,1)) }}
                    </div>
                @endif
            </div>

            <div class="font-semibold text-lg">{{ $user->nama }}</div>
            <div class="text-gray-500">{{ $user->role }}</div>
        </div>

        <!-- FORM -->
        <div class="col-span-2 bg-white rounded-xl shadow p-8">

            <h2 class="text-xl font-semibold text-[#7A2E2E] mb-6">
                Edit Profile
            </h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('siswa.profile.update') }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="font-semibold">Full Name</label>
                    <input type="text" name="nama"
                           value="{{ $user->nama }}"
                           class="w-full border p-3 rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Email</label>
                    <input type="email" name="email"
                           value="{{ $user->email }}"
                           class="w-full border p-3 rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Avatar</label>
                    <input type="file" name="avatar"
                           class="w-full border p-3 rounded-lg">
                </div>

                <button class="bg-[#7A2E2E] text-white px-6 py-2 rounded-lg">
                    Update Profile
                </button>

            </form>
        </div>

    </div>

</div>
@endsection