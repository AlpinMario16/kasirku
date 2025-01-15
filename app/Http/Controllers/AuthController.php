<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi data input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek apakah user ada dengan email yang diberikan
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Jika cocok, login user
            Auth::login($user);
            return redirect()->route('dashboard'); // Ganti dengan route yang sesuai setelah login
        }

        // Jika tidak cocok, kirim pesan error
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
{
    Auth::logout();
    return redirect()->route('login'); // Kembali ke halaman login
}
}
