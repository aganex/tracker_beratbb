<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->enum('jenis_kelamin', [
                'Laki-laki',
                'Perempuan'
            ])->nullable();

            $table->date('tanggal_lahir')->nullable();

            $table->double('target_berat', 8, 2)->nullable();

            $table->enum('aktivitas', [
                'Tidak Aktif',
                'Ringan',
                'Sedang',
                'Aktif',
                'Sangat Aktif'
            ])->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'jenis_kelamin',
                'tanggal_lahir',
                'target_berat',
                'aktivitas'
            ]);

        });
    }
};