<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pembelian;

class PembelianController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'KodeProduk.*' => 'required|string|max:255',
            'NamaProduk.*' => 'required|string|max:255',
            'id_supplier.*' => 'required|string|max:255',
            'jumlah.*' => 'required|integer|min:1',
            'GambarProduk.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        foreach ($request->KodeProduk as $index => $kodeProduk) {
            $gambar = $request->file('GambarProduk')[$index];
            $gambarPath = $gambar->store('produk', 'public');
    
            // Simpan data ke database
            Pembelian::create([
                'KodeProduk' => $kodeProduk,
                'NamaProduk' => $request->NamaProduk[$index],
                'jumlah' => $request->jumlah[$index],
                'GambarProduk' => $gambarPath,
            ]);
        }
    
        return redirect()->back()->with('success', 'Pembelian berhasil disimpan!');
    }
    
}
