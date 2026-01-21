<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('biodatas', function (Blueprint $table) {
            // Status Orang Tua
            $table->enum('status_orang_tua', ['Lengkap', 'Yatim', 'Piatu', 'Yatim Piatu'])->nullable()->after('keterangan');

            // Data Ayah
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('tahun_lahir_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('no_hp_ayah')->nullable();

            // Data Ibu
            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('tahun_lahir_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('no_hp_ibu')->nullable();

            // Data Wali
            $table->string('nama_wali')->nullable();
            $table->string('nik_wali')->nullable();
            $table->string('tahun_lahir_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();
            $table->string('no_hp_wali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodatas', function (Blueprint $table) {
            $table->dropColumn([
                'status_orang_tua',
                'nama_ayah', 'nik_ayah', 'tahun_lahir_ayah', 'pekerjaan_ayah', 'pendidikan_ayah', 'penghasilan_ayah', 'no_hp_ayah',
                'nama_ibu', 'nik_ibu', 'tahun_lahir_ibu', 'pekerjaan_ibu', 'pendidikan_ibu', 'penghasilan_ibu', 'no_hp_ibu',
                'nama_wali', 'nik_wali', 'tahun_lahir_wali', 'pekerjaan_wali', 'pendidikan_wali', 'penghasilan_wali', 'no_hp_wali'
            ]);
        });
    }
};
