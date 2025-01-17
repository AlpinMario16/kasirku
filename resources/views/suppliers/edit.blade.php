@extends('layouts.layout') <!-- Pastikan ini adalah template utama Anda -->

@section('content')
<div class="container mt-4 col-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Supplier</h5>
        </div>
        <div class="card-body">
            <form id="supplierForm" action="{{ route('suppliers.update', $supplier->id_supplier) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Supplier -->
                <div class="mb-3">
                    <label for="NamaSupplier" class="form-label">Nama Supplier</label>
                    <input 
                        type="text" 
                        class="form-control @error('NamaSupplier') is-invalid @enderror" 
                        id="NamaSupplier" 
                        name="NamaSupplier" 
                        value="{{ old('NamaSupplier', $supplier->NamaSupplier) }}" 
                        required>
                    @error('NamaSupplier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No Telepon -->
                <div class="mb-3">
                    <label for="NoTelepon" class="form-label">No Telepon</label>
                    <input 
                        type="text" 
                        class="form-control @error('NoTelepon') is-invalid @enderror" 
                        id="NoTelepon" 
                        name="NoTelepon" 
                        value="{{ old('NoTelepon', $supplier->NoTelepon) }}">
                    @error('NoTelepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="Alamat" class="form-label">Alamat</label>
                    <textarea 
                        class="form-control @error('Alamat') is-invalid @enderror" 
                        id="Alamat" 
                        name="Alamat">{{ old('Alamat', $supplier->Alamat) }}</textarea>
                    @error('Alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="button" class="btn btn-primary" onclick="confirmSubmit()">Update Supplier</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function confirmSubmit() {
        Swal.fire({
            title: "Yakin ingin mengupdate supplier?",
            text: "Pastikan data yang diisi sudah benar.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Update!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form
                document.getElementById('supplierForm').submit();

                // Menampilkan SweetAlert sukses setelah form dikirim
                Swal.fire({
                    title: "Berhasil!",
                    text: "Supplier telah berhasil diupdate.",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
