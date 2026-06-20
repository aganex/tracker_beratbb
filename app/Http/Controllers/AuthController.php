<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =====================================================
    // TAMPILKAN HALAMAN REGISTER
    // =====================================================
    public function showRegister()
    {
        return view('auth.register');
    }

    // =====================================================
    // TAMPILKAN HALAMAN LOGIN
    // =====================================================
    public function showLogin()
    {
        return view('auth.login');
    }

    // =====================================================
    // REGISTER USER
    // =====================================================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3'
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 3 karakter'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect('/login')->with('success', 'Register berhasil, silakan login');
    }

    // =====================================================
    // LOGIN
    // =====================================================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'role' => $user->role
            ]);

            // =============================================
            // REDIRECT BERDASARKAN ROLE
            // =============================================
            if ($user->role == 'admin') {
                return redirect('/admin');
            }

            return redirect('/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // =====================================================
    // LOGOUT
    // =====================================================
    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}