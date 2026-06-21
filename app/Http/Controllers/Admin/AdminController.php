<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BeratBadan;
use Illuminate\Http\Request;

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

    // =====================================================
    // HAPUS AKUN
    // =====================================================
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin')->with('success', 'User berhasil dihapus');
    }

    // =====================================================
    // EDIT AKUN
    // =====================================================
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:user,admin'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return redirect('/admin')->with('success', 'User berhasil diupdate');
    }
}