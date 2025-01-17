<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        // Ambil data supplier dengan pagination 5 per halaman
        $suppliers = Supplier::paginate(5);
    
        // Return ke view suppliers.index dengan data suppliers
        return view('suppliers.index', compact('suppliers'));
    }
    
    public function create()
    {
        // Menampilkan form tambah supplier
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'NamaSupplier' => 'required|string|max:255',
            'NoTelepon' => 'nullable|string|max:255',
            'Alamat' => 'nullable|string',
        ]);

        // Simpan supplier baru ke database
        Supplier::create([
            'NamaSupplier' => $validated['NamaSupplier'],
            'NoTelepon' => $validated['NoTelepon'],
            'Alamat' => $validated['Alamat'],
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function edit($id_supplier)
    {
        // Ambil data supplier berdasarkan id
        $supplier = Supplier::findOrFail($id_supplier);

        // Menampilkan form edit supplier
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id_supplier)
    {
        // Validasi input
        $validated = $request->validate([
            'NamaSupplier' => 'required|string|max:255',
            'NoTelepon' => 'nullable|string|max:255',
            'Alamat' => 'nullable|string',
        ]);

        // Ambil data supplier berdasarkan id
        $supplier = Supplier::findOrFail($id_supplier);

        // Update data supplier
        $supplier->update($validated);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui!');
    }

    public function destroy($id_supplier)
    {
        // Ambil data supplier berdasarkan id
        $supplier = Supplier::findOrFail($id_supplier);

        // Hapus data supplier
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('search'); // Ambil nilai pencarian dari query parameter
        $suppliers = Supplier::where('NamaSupplier', 'like', "%$searchTerm%")
                     ->orWhere('NoTelepon', 'like', "%$searchTerm%")
                     ->get(); // Ambil supplier yang sesuai dengan pencarian
    
        return response()->json($suppliers); // Kembalikan hasil pencarian dalam format JSON
    }
}
