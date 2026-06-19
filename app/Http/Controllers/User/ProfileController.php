<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    // =====================================================
    // MENAMPILKAN HALAMAN PROFILE
    // =====================================================

    public function index()
    {

        // =================================================
        // AMBIL DATA USER YANG SEDANG LOGIN
        // =================================================

        $user = User::find(session('user_id'));

        // =================================================
        // KIRIM DATA USER KE HALAMAN PROFILE
        // =================================================

        return view('user.profile', compact('user'));
    }

    // =====================================================
    // UPDATE PROFILE USER
    // =====================================================

    public function update(Request $request)
    {
        // =================================================
        // VALIDASI INPUT PROFILE
        // =================================================

        $request->validate([

            // Nama wajib diisi
            'name' =>
                'required',

            // Tinggi badan wajib angka
            'tinggi_badan' =>
                'required|numeric|min:50|max:300',

            // Jenis kelamin wajib dipilih
            'jenis_kelamin' =>
                'required',

            // Tanggal lahir wajib valid
            // dan tidak boleh lebih dari hari ini
            'tanggal_lahir' =>
                'required|date|before_or_equal:today',

            // Target berat wajib angka
            'target_berat' =>
                'required|numeric|min:20|max:300',

            // Aktivitas wajib dipilih
            'aktivitas' =>
                'required'

        ], [

            // =============================================
            // CUSTOM ERROR MESSAGE
            // =============================================

            'name.required' =>
                'Nama wajib diisi',

            'tinggi_badan.required' =>
                'Tinggi badan wajib diisi',

            'tinggi_badan.numeric' =>
                'Tinggi badan harus berupa angka',

            'tanggal_lahir.before_or_equal' =>
                'Tanggal lahir tidak valid',

            'target_berat.required' =>
                'Target berat wajib diisi',

            'aktivitas.required' =>
                'Aktivitas wajib dipilih'

        ]);

        // =================================================
        // AMBIL USER YANG SEDANG LOGIN
        // =================================================

        $userId = session('user_id');

        $user = User::find($userId);

        // =================================================
        // UPDATE DATA PROFILE USER
        // =================================================

        $user->update([

            'name' =>
                $request->name,

            'tinggi_badan' =>
                $request->tinggi_badan,

            'jenis_kelamin' =>
                $request->jenis_kelamin,

            'tanggal_lahir' =>
                $request->tanggal_lahir,

            'target_berat' =>
                $request->target_berat,

            'aktivitas' =>
                $request->aktivitas

        ]);

        // =================================================
        // UPDATE SESSION NAMA USER
        // AGAR LANGSUNG BERUBAH DI DASHBOARD
        // =================================================

        session([
            'user_name' => $user->name
        ]);

        // =================================================
        // REDIRECT KEMBALI KE PROFILE
        // =================================================

        return redirect('/dashboard')

            ->with(
                'success',
                'Profile berhasil diperbarui'
            );
    }
}