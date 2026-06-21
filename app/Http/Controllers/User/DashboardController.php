<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BeratBadan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================================================
        // AMBIL ID USER LOGIN
        // =====================================================
        $userId = session('user_id');

        // =====================================================
        // AMBIL DATA USER
        // =====================================================
        $user = User::find($userId);

        // =====================================================
        // AMBIL RIWAYAT BERAT BADAN
        // =====================================================
        $riwayat = BeratBadan::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $riwayatGrafik = BeratBadan::where('user_id', $userId)
            ->orderBy('tanggal', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        // =====================================================
        // AMBIL BERAT TERBARU
        // =====================================================
        $beratTerbaru = BeratBadan::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        // =====================================================
        // DEFAULT VALUE
        // =====================================================
        $bmi = null;
        $statusBMI = null;
        $umur = null;
        $bmr = null;
        $kaloriHarian = null;
        $sisaTarget = null;
        $beratIdeal = null;

        // =====================================================
        // CEK APAKAH USER SUDAH PUNYA:
        // - BERAT TERBARU
        // - TINGGI BADAN
        // =====================================================
        if ($beratTerbaru && $user->tinggi_badan) {

            // =================================================
            // DATA DASAR
            // =================================================
            $berat = (float) $beratTerbaru->berat;
            $tinggi = (float) $user->tinggi_badan;

            // =================================================
            // LOGIKA BMI
            // =================================================
            $tinggiMeter = $tinggi / 100;
            $bmiRaw = $berat / ($tinggiMeter * $tinggiMeter);

            // =================================================
            // STATUS BMI
            // =================================================
            if ($bmiRaw < 18.5) {
                $statusBMI = 'Kurus';
            } elseif ($bmiRaw < 25) {
                $statusBMI = 'Normal';
            } elseif ($bmiRaw < 30) {
                $statusBMI = 'Overweight';
            } else {
                $statusBMI = 'Obesitas';
            }

            // =================================================
            // FORMAT BMI
            // =================================================
            $bmi = number_format($bmiRaw, 1);

            // =================================================
            // LOGIKA BERAT IDEAL (RUMUS DEVINE)
            // =================================================
            if ($user->jenis_kelamin) {

                if ($user->jenis_kelamin == 'Laki-laki') {
                    $beratIdealRaw = 50 + (0.9 * ($tinggi - 152));
                } else {
                    $beratIdealRaw = 45.5 + (0.9 * ($tinggi - 152));
                }

                $beratIdeal = number_format($beratIdealRaw, 1);
            }

            // =================================================
            // HITUNG UMUR
            // =================================================
            if ($user->tanggal_lahir) {
                $umur = Carbon::parse($user->tanggal_lahir)->age;
            }

            // =================================================
            // LOGIKA BMR
            // =================================================
            if ($umur && $user->jenis_kelamin) {

                // =============================================
                // BMR PRIA
                // =============================================
                if ($user->jenis_kelamin == 'Laki-laki') {
                    $bmrRaw = (10 * $berat) + (6.25 * $tinggi) - (5 * $umur) + 5;
                }

                // =============================================
                // BMR WANITA
                // =============================================
                else {
                    $bmrRaw = (10 * $berat) + (6.25 * $tinggi) - (5 * $umur) - 161;
                }

                // =============================================
                // MULTIPLIER AKTIVITAS
                // =============================================
                $multiplier = 1.2;

                if ($user->aktivitas == 'Ringan') {
                    $multiplier = 1.375;
                } elseif ($user->aktivitas == 'Sedang') {
                    $multiplier = 1.55;
                } elseif ($user->aktivitas == 'Aktif') {
                    $multiplier = 1.725;
                } elseif ($user->aktivitas == 'Sangat Aktif') {
                    $multiplier = 1.9;
                }

                // =============================================
                // HITUNG KALORI HARIAN (TDEE)
                // =============================================
                $kaloriRaw = $bmrRaw * $multiplier;

                // =============================================
                // FORMAT ANGKA DI AKHIR
                // =============================================
                $bmr = number_format($bmrRaw, 0);
                $kaloriHarian = number_format($kaloriRaw, 0);

                // =============================================
                // SISA TARGET BERAT
                // =============================================
                if ($user->target_berat) {
                    $sisaRaw = $berat - (float) $user->target_berat;
                    $sisaTarget = number_format($sisaRaw, 1);
                }
            }
        }

        // =====================================================
        // KIRIM DATA KE DASHBOARD
        // =====================================================
        return view('user.dashboard', compact(
            'user',
            'riwayat',
            'riwayatGrafik',
            'beratTerbaru',
            'bmi',
            'statusBMI',
            'umur',
            'bmr',
            'kaloriHarian',
            'sisaTarget',
            'beratIdeal'
        ));
    }
}