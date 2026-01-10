<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // RPL: 2 kelas * 36 quota = 72
        // TKR: 6 kelas * 36 quota = 216
        // TPM: 5 kelas * 36 quota = 180
        // TITL: 2 kelas * 36 quota = 72
        // TKJ/TEI: 2 kelas * 36 quota = 72
        
        $quotas = [
            'RPL' => 72,
            'TKR' => 216,
            'TPM' => 180,
            'TITL' => 72,
            'TKJ' => 72,
            'TEI' => 72,
        ];

        foreach ($quotas as $kode => $kuota) {
            DB::table('jurusans')
                ->where('kode', $kode)
                ->update(['kuota' => $kuota]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to 72 (default legacy)
        DB::table('jurusans')->update(['kuota' => 72]);
    }
};
