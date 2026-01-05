<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Desa;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Sidoarjo' => [
                'Buduran' => ['Buduran', 'Semampir', 'Lontar', 'Banyu Urip', 'Pabean', 'Bringin', 'Wadung', 'Kraton'],
                'Porong' => ['Porong', 'Jatisari', 'Kedung Cowek', 'Krampon', 'Krembung Kulon', 'Krembung Wetan', 'Porong Kulon', 'Porong Wetan'],
                'Jabon' => ['Jabon', 'Jambean', 'Karangmenjangan', 'Ledokombo', 'Banjarmulyo', 'Driyorejo', 'Sidomulyo', 'Wonoagung'],
                'Krembung' => ['Krembung', 'Bedrek', 'Karangklimpit', 'Winongan', 'Watukebo', 'Tlajung', 'Kedung Cowek'],
                'Krian' => ['Krian', 'Jatisari', 'Wulung', 'Bedrek', 'Kemasan', 'Karangmulyo', 'Balongbendo', 'Kletek'],
                'Wonoayu' => ['Wonoayu', 'Gajahpanjang', 'Kupang', 'Bokoharjo', 'Karanggeneng', 'Balongbendo', 'Candimulyo', 'Kemasan'],
                'Tanggulangin' => ['Tanggulangin', 'Candimulyo', 'Balongsari', 'Jatisari', 'Kemasan', 'Kepuh Kiriman', 'Rangkah', 'Kepuh Danan'],
                'Candi' => ['Candi', 'Bedrek', 'Banyumanik', 'Griyorejo', 'Kedungmali', 'Pesanggrahan', 'Susukan', 'Nglorog'],
                'Sedati' => ['Sedati', 'Banjarsari', 'Gedangsari', 'Kamolankulon', 'Kamolanwetan', 'Kemayan', 'Ledokbanteng', 'Tanjungsari'],
                'Sutorejo' => ['Sutorejo', 'Badikan', 'Banjang', 'Bedrek', 'Gajahpanjang', 'Kemirikan', 'Melamaran', 'Suromulyo'],
                'Taman' => ['Taman', 'Bringin', 'Candi', 'Dawe', 'Gajahpanjang', 'Jetis', 'Randusari', 'Simoketawang'],
                'Gedangan' => ['Gedangan', 'Alas Malang', 'Kemiri', 'Gisik Cemandi', 'Simbang', 'Watukebo', 'Wonoasri', 'Rejo Agung'],
                'Waru' => ['Waru', 'Bedahan', 'Bungurasih', 'Kalijaten', 'Panggul', 'Parengan', 'Perbandungan', 'Tropodo']
            ],
            'Pacitan' => [
                'Pacitan' => ['Pacitan', 'Astana', 'Banaran', 'Candirejo', 'Dukuh', 'Karangagung', 'Karangan', 'Kebumen', 'Kologon', 'Krikilan', 'Kraton', 'Kuripan', 'Langkap', 'Pasir', 'Pelem', 'Pucuk', 'Purwosari', 'Sengon', 'Slegi', 'Surodadi', 'Tambakroto', 'Tanjungsari', 'Tanjungsemi', 'Tanjungwangi', 'Tejosari', 'Tempurejo', 'Terban', 'Tomesan', 'Watugajah', 'Winong'],
                'Nawangan' => ['Nawangan', 'Beji', 'Bonyoh', 'Bulak', 'Burno', 'Centil', 'Danyudan', 'Datu', 'Dersono', 'Jatisuko', 'Jero', 'Jimbasari', 'Jongkang', 'Joso', 'Kaseling', 'Kasreman', 'Kemalang', 'Kendal', 'Kepet', 'Keryorejo', 'Ketangi', 'Klagen', 'Klatingan', 'Klaten', 'Klonco', 'Klumprik', 'Kluwan', 'Kodokan', 'Komaksi', 'Komering', 'Kompol', 'Konang', 'Kondang', 'Konotilan', 'Kontan', 'Kopet', 'Koramil', 'Korban', 'Korbo', 'Koregon', 'Koremayan', 'Korenan', 'Korengan', 'Korepan', 'Koreyan', 'Korkelan', 'Korlan'],
                'Pringkuku' => ['Pringkuku', 'Adul', 'Ajung', 'Alasagung', 'Alasanbambang', 'Alasansari', 'Alas Bedug', 'Alas Bendo', 'Alasing', 'Balong', 'Bangli', 'Bangsri', 'Bangwon', 'Banjarkawis', 'Banjarlelok', 'Banjarwulan', 'Banjul', 'Banpet', 'Banyukuning', 'Banyuroto', 'Banyusari', 'Banyutowo', 'Banyuurip', 'Banyuwangen', 'Bapang'],
            ],
            'Jakarta Pusat' => [
                'Cempaka Putih' => ['Cempaka Putih Barat', 'Cempaka Putih Timur', 'Cemp Putih', 'Ciputat', 'Citayam', 'Cikokol', 'Cipinang', 'Cirebon'],
                'Johar Baru' => ['Johar Baru', 'Johar Baru', 'Johar Baru', 'Johar Baru', 'Johar Baru', 'Johar Baru', 'Johar Baru', 'Johar Baru'],
            ]
        ];

        foreach ($data as $kabupaten => $kecamatans) {
            foreach ($kecamatans as $kecamatan => $desas) {
                $kecamatanModel = Kecamatan::where('nama_kecamatan', $kecamatan)->first();
                
                if ($kecamatanModel) {
                    foreach ($desas as $desa) {
                        Desa::firstOrCreate(
                            [
                                'kecamatan_id' => $kecamatanModel->id,
                                'nama_desa' => $desa
                            ],
                            [
                                'kecamatan_id' => $kecamatanModel->id,
                                'nama_desa' => $desa
                            ]
                        );
                    }
                }
            }
        }
    }
}
