@extends('layouts.layout') <!-- Pastikan ini adalah template utama Anda -->

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Halaman Supplier</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Supplier</h6>
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Tambah Supplier</a>
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
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Supplier..." aria-label="Cari Supplier" aria-describedby="basic-addon1">
                </div>

                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="suppliersTableBody">
                        @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                            <td>{{ $supplier->NamaSupplier }}</td> <!-- Menampilkan nama supplier -->
                            <td>{{ $supplier->NoTelepon ?? '-' }}</td> <!-- Menampilkan nomor telepon, '-' jika null -->
                            <td>{{ $supplier->Alamat ?? '-' }}</td> <!-- Menampilkan alamat, '-' jika null -->
                            <td>
                                <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $supplier->id_supplier }}')">Hapus</button>
                                <form id="deleteForm-{{ $supplier->id_supplier }}" action="{{ route('suppliers.destroy', $supplier->id_supplier) }}" method="POST" style="display: none;">
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
                        {{ $suppliers->links('pagination::bootstrap-4') }} <!-- Pagination Laravel -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Pencarian supplier menggunakan input search
    document.getElementById('searchInput').addEventListener('input', function() {
        let searchValue = this.value;
        let searchUrl = "{{ route('suppliers.search') }}?search=" + searchValue; // Sesuaikan dengan rute pencarian supplier

        fetch(searchUrl)
            .then(response => response.json())
            .then(data => {
                let suppliersTable = document.getElementById('suppliersTableBody');
                suppliersTable.innerHTML = ''; // Hapus data lama

                // Menambahkan data baru ke tabel
                data.forEach(supplier => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${supplier.id_supplier}</td>
                        <td>${supplier.NamaSupplier}</td>
                        <td>${supplier.NoTelepon ?? '-'}</td>
                        <td>${supplier.Alamat ?? '-'}</td>
                        <td>
                            <a href="/suppliers/${supplier.id_supplier}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('${supplier.id_supplier}')">Hapus</button>
                        </td>
                    `;
                    suppliersTable.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
    });
</script>

<!-- SweetAlert untuk Konfirmasi Hapus -->
<script>
    function confirmDelete(supplierId) {
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
                document.getElementById('deleteForm-' + supplierId).submit();

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
@endsection
