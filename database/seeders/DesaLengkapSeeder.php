<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Support\Facades\DB;

class DesaLengkapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data desa lengkap per kecamatan
        $dataLengkap = [
            // JAWA TIMUR - SIDOARJO (Lengkap)
            'Buduran' => ['Buduran', 'Semampir', 'Lontar', 'Banyu Urip', 'Pabean', 'Bringin', 'Wadung', 'Kraton', 'Kemurejo', 'Kembang', 'Krembung'],
            'Porong' => ['Porong', 'Jatisari', 'Kedung Cowek', 'Krampon', 'Krembung Kulon', 'Krembung Wetan', 'Porong Kulon', 'Porong Wetan', 'Jambangan', 'Gebang', 'Glagah'],
            'Jabon' => ['Jabon', 'Jambean', 'Karangmenjangan', 'Ledokombo', 'Banjarmulyo', 'Driyorejo', 'Sidomulyo', 'Wonoagung', 'Badegan', 'Kepel', 'Kepet'],
            'Krembung' => ['Krembung', 'Bedrek', 'Karangklimpit', 'Winongan', 'Watukebo', 'Tlajung', 'Kedung Cowek', 'Jambangan', 'Bedahejo', 'Krembung Wetan'],
            'Krian' => ['Krian', 'Jatisari', 'Wulung', 'Bedrek', 'Kemasan', 'Karangmulyo', 'Balongbendo', 'Kletek', 'Jambangan', 'Kepul', 'Kepet'],
            'Wonoayu' => ['Wonoayu', 'Gajahpanjang', 'Kupang', 'Bokoharjo', 'Karanggeneng', 'Balongbendo', 'Candimulyo', 'Kemasan', 'Banyumanik', 'Gajahan', 'Gajahpanjang'],
            'Tanggulangin' => ['Tanggulangin', 'Candimulyo', 'Balongsari', 'Jatisari', 'Kemasan', 'Kepuh Kiriman', 'Rangkah', 'Kepuh Danan', 'Banyuagung', 'Belikurejo', 'Bekuang'],
            'Candi' => ['Candi', 'Bedrek', 'Banyumanik', 'Griyorejo', 'Kedungmali', 'Pesanggrahan', 'Susukan', 'Nglorog', 'Balungasin', 'Beduran', 'Bedrek'],
            'Sedati' => ['Sedati', 'Banjarsari', 'Gedangsari', 'Kamolankulon', 'Kamolanwetan', 'Kemayan', 'Ledokbanteng', 'Tanjungsari', 'Banjarpolo', 'Banjarwedang', 'Bengkok'],
            'Sutorejo' => ['Sutorejo', 'Badikan', 'Banjang', 'Bedrek', 'Gajahpanjang', 'Kemirikan', 'Melamaran', 'Suromulyo', 'Banyulegundi', 'Bedulur', 'Bengkol'],
            'Taman' => ['Taman', 'Bringin', 'Candi', 'Dawe', 'Gajahpanjang', 'Jetis', 'Randusari', 'Simoketawang', 'Banaran', 'Bekas', 'Bendungan'],
            'Gedangan' => ['Gedangan', 'Alas Malang', 'Kemiri', 'Gisik Cemandi', 'Simbang', 'Watukebo', 'Wonoasri', 'Rejo Agung', 'Banjarlegundi', 'Bedongan', 'Bendelan'],
            'Waru' => ['Waru', 'Bedahan', 'Bungurasih', 'Kalijaten', 'Panggul', 'Parengan', 'Perbandungan', 'Tropodo', 'Balintanya', 'Belenguyang', 'Benowo'],

            // JAWA TIMUR - PACITAN
            'Pacitan' => ['Pacitan', 'Astana', 'Banaran', 'Candirejo', 'Dukuh', 'Karangagung', 'Karangan', 'Kebumen', 'Kologon', 'Krikilan', 'Kraton', 'Kuripan', 'Langkap', 'Pasir', 'Pelem', 'Pucuk', 'Purwosari', 'Sengon', 'Slegi', 'Surodadi', 'Tambakroto', 'Tanjungsari', 'Tanjungsemi', 'Tanjungwangi', 'Tejosari', 'Tempurejo', 'Terban', 'Tomesan', 'Watugajah', 'Winong'],
            'Nawangan' => ['Nawangan', 'Beji', 'Bonyoh', 'Bulak', 'Burno', 'Centil', 'Danyudan', 'Datu', 'Dersono', 'Jatisuko', 'Jero', 'Jimbasari', 'Jongkang', 'Joso', 'Kaseling', 'Kasreman', 'Kemalang', 'Kendal', 'Kepet', 'Keryorejo'],
            'Pringkuku' => ['Pringkuku', 'Adul', 'Ajung', 'Alasagung', 'Alasanbambang', 'Alasansari', 'Alas Bedug', 'Alas Bendo', 'Alasing', 'Balong', 'Bangli', 'Bangsri', 'Bangwon', 'Banjarkawis', 'Banjarlelok'],

            // JAWA TIMUR - PONOROGO
            'Ponorogo' => ['Ponorogo', 'Banyudono', 'Dukuh', 'Jenangan', 'Jetis', 'Karangjati', 'Karangan', 'Kasreman', 'Kebonsari', 'Kemiri', 'Keraton', 'Kleco', 'Kluwan', 'Kombang', 'Kramat', 'Kraton', 'Krikilan'],
            'Jenangan' => ['Jenangan', 'Banaran', 'Bangun', 'Bangsring', 'Bangwon', 'Begajah', 'Bendungan', 'Bentar', 'Bentem', 'Bentar', 'Benteng', 'Bering', 'Berjo', 'Berkas'],

            // DKI JAKARTA - JAKARTA PUSAT
            'Cempaka Putih' => ['Cempaka Putih Barat', 'Cempaka Putih Timur'],
            'Johar Baru' => ['Johar Baru', 'Kramat'],
            'Kemayoran' => ['Kemayoran', 'Kebon Kelapa', 'Harapan Mulia'],
            'Menteng' => ['Menteng', 'Cikini', 'Gondangdia', 'Menteng Atas'],
            'Senen' => ['Senen', 'Bidara Cina', 'Kenari', 'Paseban'],
            'Tanah Abang' => ['Tanah Abang', 'Bendungan Hilir', 'Gelora', 'Petojo Utara', 'Petojo Selatan'],

            // DKI JAKARTA - JAKARTA UTARA
            'Ancol' => ['Ancol', 'Kali Besar Barat', 'Kali Besar Timur'],
            'Cilincing' => ['Cilincing', 'Penjaringan', 'Rorotan', 'Marunda', 'Muara Angke'],
            'Kelapa Gading' => ['Kelapa Gading', 'Penjaringan Timur', 'Penjaringan Barat', 'Kelapa Gading Barat'],
            'Penjaringan' => ['Penjaringan', 'Kedung Cowek', 'Pluit', 'Puri Safira'],
            'Tanjung Priok' => ['Tanjung Priok', 'Kebon Bawang', 'Kebon Kosong', 'Papanggo', 'Priok'],

            // JAWA BARAT - BOGOR
            'Bogor Timur' => ['Cilangkap', 'Katulampa', 'Kertamaya', 'Tanahbaru'],
            'Bogor Barat' => ['Balumbang Jaya', 'Balumbang Lestari', 'Cilendek Barat', 'Cilendek Timur'],
            'Bogor Utara' => ['Kebon Pedes', 'Kedung Halang', 'Kujangsari'],
            'Bogor Selatan' => ['Babakan', 'Babakan Pasar', 'Bantarjati', 'Cikiwul'],
            'Bogor Tengah' => ['Kebon Kelapa', 'Semeru', 'Tanah Sareal'],
            'Cibinong' => ['Cibinong', 'Pondok Gede', 'Ciseeng', 'Harjamukti', 'Kemang', 'Kemang Pratama', 'Pabuaran'],
            'Cigudeg' => ['Cigudeg', 'Kadudampit', 'Kadumanggal', 'Karangawen', 'Kawungcopak'],
            'Cijeruk' => ['Cijeruk', 'Bongas', 'Cabangbitung', 'Citapen', 'Gede Bage'],
            'Cileungsi' => ['Cileungsi', 'Baru', 'Cileungsi Kidul', 'Pasirmulya', 'Rawa Bening'],
            'Caringin' => ['Caringin', 'Kampung Loji', 'Nambo', 'Pengkol'],
            'Cariu' => ['Cariu', 'Bantar Gebang', 'Bintaro', 'Citayam', 'Curug'],
            'Citeureup' => ['Citeureup', 'Cilodong', 'Karang Satria', 'Pabuaran'],
            'Cibungbulang' => ['Cibungbulang', 'Cicantayan', 'Cigombong', 'Cikaos', 'Curangmekar'],
            'Ciampea' => ['Ciampea', 'Ciplak', 'Situsari', 'Tipar'],
        ];

        // Insert desa data
        foreach ($dataLengkap as $kecamatanName => $desas) {
            $kecamatan = Kecamatan::where('nama_kecamatan', $kecamatanName)->first();
            
            if ($kecamatan) {
                foreach ($desas as $desaName) {
                    // Cek apakah desa sudah ada
                    $exists = Desa::where('kecamatan_id', $kecamatan->id)
                        ->where('nama_desa', $desaName)
                        ->exists();
                    
                    if (!$exists) {
                        Desa::create([
                            'kecamatan_id' => $kecamatan->id,
                            'nama_desa' => $desaName
                        ]);
                    }
                }
            }
        }

        $this->command->info('Desa seeding completed successfully!');
    }
}
