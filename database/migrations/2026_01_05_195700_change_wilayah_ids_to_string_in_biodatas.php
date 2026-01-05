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
            // Drop foreign key constraints
            $table->dropForeign(['provinsi_id']);
            $table->dropForeign(['kabupaten_id']);
            $table->dropForeign(['kecamatan_id']);
            $table->dropForeign(['desa_id']);
            
            // Change columns to string
            $table->string('provinsi_id')->nullable()->change();
            $table->string('kabupaten_id')->nullable()->change();
            $table->string('kecamatan_id')->nullable()->change();
            $table->string('desa_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodatas', function (Blueprint $table) {
            // Change back to unsignedBigInteger
            $table->unsignedBigInteger('provinsi_id')->nullable()->change();
            $table->unsignedBigInteger('kabupaten_id')->nullable()->change();
            $table->unsignedBigInteger('kecamatan_id')->nullable()->change();
            $table->unsignedBigInteger('desa_id')->nullable()->change();
            
            // Re-add foreign key constraints
            $table->foreign('provinsi_id')->references('id')->on('provinsis')->onDelete('set null');
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('set null');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('set null');
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('set null');
        });
    }
};
