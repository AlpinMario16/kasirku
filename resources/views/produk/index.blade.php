@extends('layouts.layout') <!-- Pastikan ini adalah template utama Anda -->

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Halaman Produk</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
            <a href="{{ route('produks.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
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
    <input type="text" id="searchInput" class="form-control" placeholder="Cari Produk..." aria-label="Cari Produk" aria-describedby="basic-addon1">
</div>


                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="produksTableBody">
                        @foreach ($produks as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                            <td>{{ $produk->name }}</td> <!-- Menampilkan nama -->
                            <td>{{ $produk->email }}</td> <!-- Menampilkan email -->
                            <td>{{ ucfirst($produk->role) }}</td> <!-- Menampilkan role dengan huruf pertama kapital -->
                            <td>
                                <a href="{{ route('produks.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $produk->id }}')">Hapus</button>
                                <form id="deleteForm-{{ $produk->id }}" action="{{ route('produks.destroy', $produk->id) }}" method="POST" style="display: none;">
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
        {{ $produks->links('pagination::bootstrap-4') }}
    </div>
</div>



            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let searchValue = this.value;
        let searchUrl = "{{ route('produks.search') }}?search=" + searchValue; // Pastikan URL benar

        fetch(searchUrl)
            .then(response => response.json())
            .then(data => {
                let produksTable = document.getElementById('produksTableBody');
                produksTable.innerHTML = ''; // Hapus data lama

                // Menambahkan data baru ke tabel
                data.forEach(produk => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${produk.id}</td>
                        <td>${produk.name}</td>
                        <td>${produk.email}</td>
                        <td>${produk.role}</td>
                        <td>
                            <a href="/produks/${produk.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('${produk.id}')">Hapus</button>
                        </td>
                    `;
                    produksTable.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
    });
</script>




<!-- SweetAlert untuk Konfirmasi Hapus -->
<script>
    function confirmDelete(produkId) {
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
                document.getElementById('deleteForm-' + produkId).submit();

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
