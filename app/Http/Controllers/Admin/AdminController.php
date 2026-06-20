<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BeratBadan;

class AdminController extends Controller
{
    public function index()
    {
        // =====================================================
        // STATISTIK USER
        // =====================================================
        $totalUser = User::where('role', 'user')->count();

        $totalPria = User::where('role', 'user')
            ->where('jenis_kelamin', 'Laki-laki')
            ->count();

        $totalWanita = User::where('role', 'user')
            ->where('jenis_kelamin', 'Perempuan')
            ->count();

        // =====================================================
        // SEARCH USER
        // =====================================================
        $search = request('search');

        // =====================================================
        // DAFTAR AKUN
        // =====================================================
        $users = User::where('role', 'user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // =====================================================
        // KIRIM KE VIEW
        // =====================================================
        return view('admin.dashboard', compact(
            'totalUser',
            'totalPria',
            'totalWanita',
            'users'
        ));
    }
}