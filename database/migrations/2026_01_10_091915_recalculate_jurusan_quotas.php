<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Jurusan;
use App\Models\Biodata;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Define Max Capacities
        $maxCapacities = [
            'RPL' => 72,
            'TKR' => 216,
            'TPM' => 180,
            'TITL' => 72,
            'TKJ' => 72,
            'TEI' => 72,
        ];

        foreach ($maxCapacities as $kode => $max) {
            $jurusan = Jurusan::where('kode', $kode)->first();
            if ($jurusan) {
                // Count used slots
                $used = Biodata::where('jurusan_id', $jurusan->id)->count();
                
                // Calculate remaining
                $remaining = max(0, $max - $used);
                
                $jurusan->kuota = $remaining;
                $jurusan->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No distinct down action as this is a sync operation
    }
};
