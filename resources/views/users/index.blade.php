@extends('layouts.layout') <!-- Pastikan ini adalah template utama Anda -->

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Halaman User</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
           <!-- Pencarian -->
           <div class="input-group mb-3 col-6"> <!-- Menambahkan kelas col-6 untuk setengah lebar -->
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-search"></i> <!-- Ikon pencarian -->
        </span>
    </div>
    <input type="text" id="searchInput" class="form-control" placeholder="Cari User..." aria-label="Cari User" aria-describedby="basic-addon1">
</div>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                            <td>{{ $user->name }}</td> <!-- Menampilkan nama -->
                            <td>{{ $user->email }}</td> <!-- Menampilkan email -->
                            <td>{{ ucfirst($user->role) }}</td> <!-- Menampilkan role dengan huruf pertama kapital -->
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $user->id }}')">Hapus</button>
                                <form id="deleteForm-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                  <!-- Pagination -->
                  <div class="d-flex justify-content-center mt-4"> 
    <div>
        <!-- Pagination rata tengah -->
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>



            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let searchValue = this.value;
        let searchUrl = "{{ route('users.search') }}?search=" + searchValue; // Pastikan URL benar

        fetch(searchUrl)
            .then(response => response.json())
            .then(data => {
                let usersTable = document.getElementById('usersTableBody');
                usersTable.innerHTML = ''; // Hapus data lama

                // Menambahkan data baru ke tabel
                data.forEach(user => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role}</td>
                        <td>
                            <a href="/users/${user.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('${user.id}')">Hapus</button>
                        </td>
                    `;
                    usersTable.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
    });
</script>




<!-- SweetAlert untuk Konfirmasi Hapus -->
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data ini tidak dapat dikembalikan lagi!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form untuk menghapus data
                document.getElementById('deleteForm-' + userId).submit();

                // Tampilkan pesan sukses
                Swal.fire({
                    title: "Dihapus!",
                    text: "Data telah berhasil dihapus.",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    }
</script>



<!-- SweetAlert untuk Session Success -->


@endsection
