<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
   
    public function showAuth()
    {
        return view('auth.auth'); // file auth.blade.php
    }


    // login
    public function login(Request $request)
    {
        // Validasi
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:3'
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {

            $role = Auth::user()->role;

            // Arahkan sesuai role
            if ($role === 'admin') {
                return redirect('/admin/dashboard');
            }
            if ($role === 'petugas') {
                return redirect('/petugas/dashboard');
            }

            return redirect('/pelanggan/dashboard'); // default pelanggan
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!'
        ]);
    }


    // register
    public function register(Request $request)
    {
        // Validasi
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|string' // dari hidden input (pelanggan)
        ]);

        // Simpan user ke database
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,  // pelanggan
        ]);

        // Auto login
        Auth::login($user);

        return redirect('/pelanggan/dashboard');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
