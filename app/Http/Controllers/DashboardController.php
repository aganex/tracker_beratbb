<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BeratBadan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================================================
        // CEK APAKAH USER SUDAH LOGIN
        // =====================================================

        if (!session()->has('user_id')) {

            return redirect('/login');
        }

        // =====================================================
        // AMBIL DATA USER YANG SEDANG LOGIN
        // =====================================================

        $user = User::find(session('user_id'));

        // =====================================================
        // AMBIL SEMUA RIWAYAT BERAT BADAN USER
        // =====================================================

        $riwayat = BeratBadan::where(
                'user_id',
                session('user_id')
            )
            ->orderBy('tanggal', 'desc')
            ->get();

        // =====================================================
        // AMBIL BERAT BADAN TERBARU USER
        // =====================================================

        $beratTerbaru = BeratBadan::where(
                'user_id',
                session('user_id')
            )
            ->orderBy('tanggal', 'desc')
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

            $bmiRaw =
                $berat /
                ($tinggiMeter * $tinggiMeter);

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
            // HITUNG UMUR
            // =================================================

            if ($user->tanggal_lahir) {

                $umur = Carbon::parse(
                    $user->tanggal_lahir
                )->age;
            }

            // =================================================
            // LOGIKA BMR
            // =================================================

            if (
                $umur &&
                $user->jenis_kelamin
            ) {

                // =============================================
                // BMR PRIA
                // =============================================

                if (
                    $user->jenis_kelamin
                    == 'Laki-laki'
                ) {

                    $bmrRaw =
                        (10 * $berat)
                        + (6.25 * $tinggi)
                        - (5 * $umur)
                        + 5;

                }

                // =============================================
                // BMR WANITA
                // =============================================

                else {

                    $bmrRaw =
                        (10 * $berat)
                        + (6.25 * $tinggi)
                        - (5 * $umur)
                        - 161;
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

                } elseif (
                    $user->aktivitas
                    == 'Sangat Aktif'
                ) {

                    $multiplier = 1.9;
                }

                // =============================================
                // HITUNG KALORI HARIAN (TDEE)
                // =============================================

                $kaloriRaw =
                    $bmrRaw * $multiplier;

                // =============================================
                // FORMAT ANGKA DI AKHIR
                // =============================================

                $bmr = number_format(
                    $bmrRaw,
                    0
                );

                $kaloriHarian = number_format(
                    $kaloriRaw,
                    0
                );

                // =============================================
                // SISA TARGET BERAT
                // =============================================

                if ($user->target_berat) {

                    $sisaRaw =
                        $berat
                        - (float) $user->target_berat;

                    $sisaTarget = number_format(
                        $sisaRaw,
                        1
                    );
                }
            }
        }

        // =====================================================
        // KIRIM DATA KE DASHBOARD
        // =====================================================

        return view('dashboard', compact(

            'user',

            'riwayat',

            'beratTerbaru',

            'bmi',

            'statusBMI',

            'umur',

            'bmr',

            'kaloriHarian',

            'sisaTarget'

        ));
    }
}