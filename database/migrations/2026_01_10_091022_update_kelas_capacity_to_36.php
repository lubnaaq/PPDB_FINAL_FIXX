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
        // Update existing classes capacity to 36
        DB::table('kelas')->update(['kapasitas' => 36]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to 20 (original default)
        DB::table('kelas')->update(['kapasitas' => 20]);
    }
};
