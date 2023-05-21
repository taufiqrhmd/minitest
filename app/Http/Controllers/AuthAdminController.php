<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function LoginAdminPage()
    {
        return view('admin.login');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $akun = Admin::where('username', $request->username)->first();

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

        Auth::login($akun);
        return redirect()->route('admin.daftarartikel');
    }
}
