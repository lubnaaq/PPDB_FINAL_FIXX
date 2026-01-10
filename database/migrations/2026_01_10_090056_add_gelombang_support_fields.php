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
        Schema::table('jurusans', function (Blueprint $table) {
            if (!Schema::hasColumn('jurusans', 'harga')) {
                $table->decimal('harga', 12, 2)->default(0)->after('kuota');
            }
        });

        Schema::table('biodatas', function (Blueprint $table) {
            if (!Schema::hasColumn('biodatas', 'gelombang_id')) {
                $table->foreignId('gelombang_id')->nullable()->constrained('gelombangs')->onDelete('set null')->after('jurusan_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            if (Schema::hasColumn('jurusans', 'harga')) {
                $table->dropColumn('harga');
            }
        });

        Schema::table('biodatas', function (Blueprint $table) {
            if (Schema::hasColumn('biodatas', 'gelombang_id')) {
                $table->dropForeign(['gelombang_id']);
                $table->dropColumn('gelombang_id');
            }
        });
    }
};
