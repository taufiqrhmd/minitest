<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function LoginPage()
    {
        return view('auth.login');
    }

    public function RegisterPage()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $akun = Penulis::where('username', $request->username)->first();

        if (!$akun) {
            return back()
                ->withErrors([
                    'username' => 'Akun tidak terdaftar!',
                ])
                ->withInput();
        }

        if ($request->password !== $akun->password) {
            return back()
                ->withErrors([
                    'username' => 'username atau Password yang diinputkan salah!',
                ])
                ->withInput();
        }

        if ($akun->status != "Aktif") {
            return back()
                ->withErrors([
                    'username' => 'Akun belum terverifikasi!',
                ])
                ->withInput();
        }

        Auth::login($akun);
        return redirect()->route('penulis.daftarArtikel');
    }

    public function register(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'username' => 'required|string|max:50|unique:tb_penulis',
            'password' => 'required|string|min:8',
        ]);

        // buat user baru
        $user = Penulis::create([
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'status' => "Tidak Aktif", // set hak akses sebagai Admin
        ]);

        if ($request->username !== $user->username) {
            return back()
                ->withErrors([
                    'username' => 'Username sudah terdaftar!',
                ])
                ->withInput();
        }

        // redirect ke halaman setelah berhasil login
        return view('auth.login');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
