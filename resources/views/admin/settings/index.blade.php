@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen">

    <div class="grid grid-cols-3 gap-8">

        <!-- PROFILE CARD -->
        <div class="bg-white rounded-2xl shadow border border-[#f3d6d6] p-6 text-center">

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

            <div class="font-semibold text-lg text-[#7A2E2E]">{{ $user->nama }}</div>
            <div class="text-gray-500">{{ $user->role }}</div>
        </div>

        <!-- ACCOUNT INFO -->
        <div class="col-span-2 bg-white rounded-2xl shadow border border-[#f3d6d6] p-8">

            <h2 class="text-xl font-semibold text-[#7A2E2E] mb-6">
                Account Information
            </h2>

            @if(session('success'))
                <div class="bg-[#fde8e8] text-[#7A2E2E] p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.settings.update') }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="font-semibold text-[#7A2E2E]">Full Name</label>
                    <input type="text" name="nama"
                           value="{{ $user->nama }}"
                           class="w-full border border-[#f3d6d6] p-3 rounded-lg focus:ring-2 focus:ring-[#7A2E2E] outline-none">
                </div>

                <div class="mb-4">
                    <label class="font-semibold text-[#7A2E2E]">Email Address</label>
                    <input type="email" name="email"
                           value="{{ $user->email }}"
                           class="w-full border border-[#f3d6d6] p-3 rounded-lg focus:ring-2 focus:ring-[#7A2E2E] outline-none">
                </div>

                <div class="mb-4">
                    <label class="font-semibold text-[#7A2E2E]">Avatar</label>
                    <input type="file" name="avatar"
                           class="w-full border border-[#f3d6d6] p-3 rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="font-semibold text-[#7A2E2E]">New Password</label>
                    <input type="password" name="password"
                           class="w-full border border-[#f3d6d6] p-3 rounded-lg focus:ring-2 focus:ring-[#7A2E2E] outline-none">
                </div>

                <button class="bg-[#7A2E2E] text-white px-6 py-2 rounded-lg hover:opacity-90 transition">
                    Save Changes
                </button>

            </form>
        </div>

    </div>
</div>
@endsection