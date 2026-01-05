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
            if (!Schema::hasColumn('biodatas', 'provinsi_id')) {
                $table->foreignId('provinsi_id')->nullable()->after('provinsi')->constrained('provinsis')->onDelete('set null');
            }
            if (!Schema::hasColumn('biodatas', 'kabupaten_id')) {
                $table->foreignId('kabupaten_id')->nullable()->after('provinsi_id')->constrained('kabupatens')->onDelete('set null');
            }
            if (!Schema::hasColumn('biodatas', 'kecamatan_id')) {
                $table->foreignId('kecamatan_id')->nullable()->after('kabupaten_id')->constrained('kecamatans')->onDelete('set null');
            }
            if (!Schema::hasColumn('biodatas', 'desa_id')) {
                $table->foreignId('desa_id')->nullable()->after('kecamatan_id')->constrained('desas')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodatas', function (Blueprint $table) {
            if (Schema::hasColumn('biodatas', 'desa_id')) {
                $table->dropForeignIdFor('desa_id');
                $table->dropColumn('desa_id');
            }
            if (Schema::hasColumn('biodatas', 'kecamatan_id')) {
                $table->dropForeignIdFor('kecamatan_id');
                $table->dropColumn('kecamatan_id');
            }
            if (Schema::hasColumn('biodatas', 'kabupaten_id')) {
                $table->dropForeignIdFor('kabupaten_id');
                $table->dropColumn('kabupaten_id');
            }
            if (Schema::hasColumn('biodatas', 'provinsi_id')) {
                $table->dropForeignIdFor('provinsi_id');
                $table->dropColumn('provinsi_id');
            }
        });
    }
};
