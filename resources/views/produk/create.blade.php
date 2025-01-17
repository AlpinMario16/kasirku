@extends('layouts.layout') <!-- Pastikan ini adalah template utama Anda -->

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Form Pembelian Barang</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="dynamic-form">
                    <!-- Row pertama -->
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="KodeProduk">Kode Produk</label>
                            <input type="text" name="KodeProduk[]" class="form-control" placeholder="Masukkan Kode Produk" required>
                        </div>
                        <div class="col-md-3">
                            <label for="NamaProduk">Nama Produk</label>
                            <input type="text" name="NamaProduk[]" class="form-control" placeholder="Masukkan Nama Produk" required>
                        </div>
                        <div class="col-md-2">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah[]" class="form-control" placeholder="Masukkan Jumlah" required>
                        </div>
                        <div class="col-md-2">
                            <label for="GambarProduk">Gambar Produk</label>
                            <input type="file" name="GambarProduk[]" class="form-control" accept="image/*" required>
                        </div>
                        <div class="col-md-2">
                            <label for="Supplier">Nama Supplier</label>
                            <input type="text" name="Supplier[]" class="form-control" placeholder="Nama Supplier" required>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-success add-row">Tambah</button>
                        </div>
                    </div>
                </div>

                <!-- Bagian Keranjang dan Pembayaran -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-secondary" id="add-to-cart">Tambah ke Keranjang</button>
                    </div>
                    <div class="col-md-4">
                        <label for="bayar">Bayar</label>
                        <input type="number" id="bayar" class="form-control" placeholder="Jumlah Uang Pelanggan">
                    </div>
                    <div class="col-md-4">
                        <label for="kembalian">Kembalian</label>
                        <input type="text" id="kembalian" class="form-control" placeholder="Kembalian" readonly>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Bayar</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Tambah baris baru untuk produk
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-row')) {
            const newRow = `
                <div class="row mb-3">
                    <div class="col-md-2">
                        <input type="text" name="KodeProduk[]" class="form-control" placeholder="Masukkan Kode Produk" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="NamaProduk[]" class="form-control" placeholder="Masukkan Nama Produk" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="jumlah[]" class="form-control" placeholder="Masukkan Jumlah" required>
                    </div>
                    <div class="col-md-2">
                        <input type="file" name="GambarProduk[]" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="Supplier[]" class="form-control" placeholder="Nama Supplier" required>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-row">Hapus</button>
                    </div>
                </div>
            `;
            document.getElementById('dynamic-form').insertAdjacentHTML('beforeend', newRow);
        }

        // Hapus baris produk
        if (event.target.classList.contains('remove-row')) {
            event.target.closest('.row').remove();
        }
    });

    // Hitung kembalian otomatis
    document.getElementById('bayar').addEventListener('input', function () {
        const totalHarga = calculateTotal(); // Tambahkan fungsi hitung total harga jika diperlukan
        const bayar = parseFloat(this.value) || 0;
        const kembalian = bayar - totalHarga;

        document.getElementById('kembalian').value = kembalian >= 0 ? kembalian.toFixed(2) : 'Uang tidak cukup';
    });

    // Placeholder fungsi hitung total (implementasikan jika ada data harga)
    function calculateTotal() {
        // Misalnya mengambil total harga dari keranjang
        return 100000; // Ubah sesuai implementasi Anda
    }
</script>
@endsection
