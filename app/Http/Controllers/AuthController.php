<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }
    public function showLogin()
    {
        return view('auth.login');
    }

    // Register
    public function register(Request $request)
    {
        // VALIDASI USER
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3'
        ], [
            'email.unique' => 'Email sudah terdaftar'
        ]);

        // PROSES USER
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Register berhasil, silakan login');
    }

    // LOGIN
    public function login(Request $request)
    {
        $request->validate([

            'email' =>
                'required|email',

            'password' =>
                'required'

        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (
            $user &&
            Hash::check(
                $request->password,
                $user->password
            )
        ) {

            session([

                'user_id' =>
                    $user->id,

                'user_name' =>
                    $user->name

            ]);

            return redirect('/dashboard');
        }

        return back()->with(
            'error',
            'Email atau password salah'
        );
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
