<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GelombangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Gelombang::create([
            'nama' => 'Gelombang 1',
            'tanggal_mulai' => '2026-01-01',
            'tanggal_selesai' => '2026-03-31',
            'potongan' => 500000,
            'aktif' => true,
        ]);

        \App\Models\Gelombang::create([
            'nama' => 'Gelombang 2',
            'tanggal_mulai' => '2026-04-01',
            'tanggal_selesai' => '2026-06-30',
            'potongan' => 250000,
            'aktif' => true,
        ]);

        \App\Models\Gelombang::create([
            'nama' => 'Gelombang 3',
            'tanggal_mulai' => '2026-07-01',
            'tanggal_selesai' => '2026-08-31',
            'potongan' => 0,
            'aktif' => true,
        ]);
    }
}
