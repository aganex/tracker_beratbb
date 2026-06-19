<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeratBadan;

class BeratBadanController extends Controller
{
    // =====================================================
    // MENYIMPAN DATA BERAT BADAN USER
    // =====================================================

    public function store(Request $request)
    {

        // =================================================
        // VALIDASI INPUT BERAT BADAN
        // =================================================

        $request->validate([

            // Berat badan wajib angka
            'berat' =>
                'required|numeric|min:20|max:300',

            // Tanggal wajib valid
            // dan tidak boleh lebih dari hari ini
            'tanggal' =>
                'required|date|before_or_equal:today'

        ], [

            // =============================================
            // CUSTOM ERROR MESSAGE
            // =============================================

            'berat.required' =>
                'Berat badan wajib diisi',

            'berat.numeric' =>
                'Berat badan harus berupa angka',

            'tanggal.required' =>
                'Tanggal wajib diisi',

            'tanggal.before_or_equal' =>
                'Tanggal tidak boleh melebihi hari ini'

        ]);

        // =================================================
        // SIMPAN DATA BERAT BADAN KE DATABASE
        // =================================================

        BeratBadan::create([

            'user_id' =>
                session('user_id'),

            'berat' =>
                $request->berat,

            'tanggal' =>
                $request->tanggal

        ]);

        // =================================================
        // REDIRECT KEMBALI KE DASHBOARD
        // =================================================

        return redirect('/dashboard')

            ->with(
                'success',
                'Berat badan berhasil ditambahkan'
            );
    }
}