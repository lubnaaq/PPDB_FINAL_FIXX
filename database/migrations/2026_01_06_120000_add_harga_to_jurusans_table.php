<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            if (!Schema::hasColumn('jurusans', 'harga_gelombang_1')) {
                $table->decimal('harga_gelombang_1', 12, 2)->default(0)->after('kuota');
            }
            if (!Schema::hasColumn('jurusans', 'harga_gelombang_2')) {
                $table->decimal('harga_gelombang_2', 12, 2)->default(0)->after('harga_gelombang_1');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            if (Schema::hasColumn('jurusans', 'harga_gelombang_1')) {
                $table->dropColumn('harga_gelombang_1');
            }
            if (Schema::hasColumn('jurusans', 'harga_gelombang_2')) {
                $table->dropColumn('harga_gelombang_2');
            }
        });
    }
};
