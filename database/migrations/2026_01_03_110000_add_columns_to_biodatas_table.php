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
            if (!Schema::hasColumn('biodatas', 'nama_lengkap')) {
                $table->string('nama_lengkap')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('biodatas', 'email')) {
                $table->string('email')->nullable()->after('nama_lengkap');
            }
            if (!Schema::hasColumn('biodatas', 'nomor_telepon')) {
                $table->string('nomor_telepon')->nullable()->after('email');
            }
            if (!Schema::hasColumn('biodatas', 'jenis_kelamin')) {
                $table->string('jenis_kelamin', 2)->nullable()->after('nomor_telepon');
            }
            if (!Schema::hasColumn('biodatas', 'tempat_lahir')) {
                $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            }
            if (!Schema::hasColumn('biodatas', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            }
            if (!Schema::hasColumn('biodatas', 'agama')) {
                $table->string('agama')->nullable()->after('tanggal_lahir');
            }
            if (!Schema::hasColumn('biodatas', 'alamat')) {
                $table->text('alamat')->nullable()->after('agama');
            }
            if (!Schema::hasColumn('biodatas', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('biodatas', 'kota')) {
                $table->string('kota')->nullable()->after('provinsi');
            }
            if (!Schema::hasColumn('biodatas', 'kode_pos')) {
                $table->string('kode_pos')->nullable()->after('kota');
            }
            if (!Schema::hasColumn('biodatas', 'instansi')) {
                $table->string('instansi')->nullable()->after('kode_pos');
            }
            if (!Schema::hasColumn('biodatas', 'hobi')) {
                $table->text('hobi')->nullable()->after('instansi');
            }
            if (!Schema::hasColumn('biodatas', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('hobi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodatas', function (Blueprint $table) {
            $cols = [
                'keterangan', 'hobi', 'instansi', 'kode_pos', 'kota', 'provinsi', 'alamat', 'agama', 'tanggal_lahir', 'tempat_lahir', 'jenis_kelamin', 'nomor_telepon', 'email', 'nama_lengkap'
            ];

            foreach ($cols as $col) {
                if (Schema::hasColumn('biodatas', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
