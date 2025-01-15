@extends('layouts.layout') <!-- Pastikan ini adalah template utama Anda -->

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah User</h5>
        </div>
        <div class="card-body">
            <form id="userForm" action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                        <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                    </select>
                    @error('role')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="button" class="btn btn-primary" onclick="confirmSubmit()">Tambah User</button>

            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function confirmSubmit() {
        Swal.fire({
            title: "Yakin ingin menambahkan user?",
            text: "Pastikan data yang diisi sudah benar.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Tambahkan!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form
                document.getElementById('userForm').submit();

                // Menampilkan SweetAlert sukses setelah form dikirim
                Swal.fire({
                    title: "Berhasil!",
                    text: "User telah berhasil ditambahkan.",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }
</script>



