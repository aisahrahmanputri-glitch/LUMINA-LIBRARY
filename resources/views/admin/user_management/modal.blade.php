<div id="modalUser"
class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div id="modalBox"
         class="bg-white w-[500px] p-6 rounded-xl shadow
                scale-95 opacity-0 transition duration-200">

        <button onclick="closeModal()" class="absolute right-4 top-3">✕</button>

        <h2 class="text-xl font-semibold text-center mb-4 text-[#7A2E2E]">
            Add User
        </h2>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <label>Name</label>
            <input name="nama" class="input-style" required>

            <label>Email</label>
            <input name="email" class="input-style" required>

            <label>Password</label>
            <input type="password" name="password" class="input-style" required>

            <label>Role</label>
            <select name="role" class="input-style mb-4">
                <option value="siswa">Borrower</option>
                <option value="petugas">Officer</option>
            </select>

            <div class="flex justify-end">
                <button class="bg-[#7A2E2E] text-white px-5 py-2 rounded">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.input-style{
    width:100%;
    background:#7A2E2E;
    color:white;
    padding:8px;
    border-radius:6px;
    margin-bottom:10px;
}
</style>
