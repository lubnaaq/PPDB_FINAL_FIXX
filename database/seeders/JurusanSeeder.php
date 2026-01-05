<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = [
            [
                'nama' => 'Teknik Permesinan',
                'kode' => 'TPM',
                'deskripsi' => 'Mempelajari proses produksi logam, pengoperasian mesin bubut, frais, gerinda, dan CNC.',
                'kuota' => 72,
                'harga_gelombang_1' => 4280000,
                'harga_gelombang_2' => 4480000,
            ],
            [
                'nama' => 'Teknik Kendaraan Ringan',
                'kode' => 'TKR',
                'deskripsi' => 'Mempelajari perawatan dan perbaikan kendaraan ringan (mobil), sistem mesin, kelistrikan, dan chasis.',
                'kuota' => 72,
                'harga_gelombang_1' => 4430000,
                'harga_gelombang_2' => 4655000,
            ],
            [
                'nama' => 'Rekayasa Perangkat Lunak',
                'kode' => 'RPL',
                'deskripsi' => 'Fokus pada pengembangan perangkat lunak, pemrograman web, mobile, dan desktop.',
                'kuota' => 72,
                'harga_gelombang_1' => 4330000,
                'harga_gelombang_2' => 4530000,
            ],
            [
                'nama' => 'Teknik Instalasi Tenaga Listrik',
                'kode' => 'TITL',
                'deskripsi' => 'Mempelajari instalasi penerangan, tenaga listrik, motor listrik, dan sistem kendali.',
                'kuota' => 72,
                'harga_gelombang_1' => 4280000,
                'harga_gelombang_2' => 4480000,
            ],
            [
                'nama' => 'Teknik Elektronika Industri',
                'kode' => 'TEI',
                'deskripsi' => 'Mempelajari sistem kontrol elektronik, pneumatik, hidrolik, dan pemrograman PLC untuk industri.',
                'kuota' => 72,
                'harga_gelombang_1' => 3780000,
                'harga_gelombang_2' => 4030000,
            ],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::updateOrCreate(
                ['kode' => $jurusan['kode']],
                $jurusan
            );
        }
    }
}
