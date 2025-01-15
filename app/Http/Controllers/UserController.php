<?php

namespace App\Http\Controllers;

use App\Models\User; // Import model User
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua data user dari database
        $users = User::all();

        // Return ke view users.index dengan mengirimkan data $users
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // Menampilkan form tambah user
        return view('users.create');
    }

     // Menyimpan user baru
     public function store(Request $request)
     {
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|min:6',
             'role' => 'required|in:superadmin,operator',
         ]);
     
         User::create([
             'name' => $validated['name'],
             'email' => $validated['email'],
             'password' => bcrypt($validated['password']),
             'role' => $validated['role'],
         ]);
     
         return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
     }
     

    public function edit($id)
    {
        // Ambil data user berdasarkan id
        $user = User::findOrFail($id);

        // Menampilkan form edit user
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:superadmin,operator',
        ]);

        // Ambil data user berdasarkan id
        $user = User::findOrFail($id);

        // Update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);

        // Redirect ke halaman users.index
        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Ambil data user berdasarkan id
        $user = User::findOrFail($id);

        // Hapus data user
        $user->delete();

        // Redirect ke halaman users.index
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
