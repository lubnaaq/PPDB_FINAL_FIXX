<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Desa;

class DesaComprehensiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataLengkap = [
            // JAWA TIMUR - SIDOARJO (13 Kecamatan)
            'Buduran' => [
                'Buduran', 'Semampir', 'Lontar', 'Banyu Urip', 'Pabean', 'Bringin', 'Wadung', 'Kraton',
                'Kemurejo', 'Kembang', 'Krembung', 'Kemiri', 'Kedung Cowek', 'Krembung Wetan', 'Krembung Kulon',
                'Bedrek', 'Banyumanik', 'Griyorejo', 'Kedungmali', 'Pesanggrahan'
            ],
            'Porong' => [
                'Porong', 'Jatisari', 'Kedung Cowek', 'Krampon', 'Krembung Kulon', 'Krembung Wetan', 'Porong Kulon',
                'Porong Wetan', 'Jambangan', 'Gebang', 'Glagah', 'Gajahpanjang', 'Gajahan', 'Gatik', 'Gatak',
                'Gembol', 'Gemer', 'Gerekan', 'Gerja', 'Gersik'
            ],
            'Jabon' => [
                'Jabon', 'Jambean', 'Karangmenjangan', 'Ledokombo', 'Banjarmulyo', 'Driyorejo', 'Sidomulyo',
                'Wonoagung', 'Badegan', 'Kepel', 'Kepet', 'Karangagung', 'Karanganyar', 'Karangasem', 'Karangbendo',
                'Karangblulur', 'Karangdawu', 'Karanggedang', 'Karanggondang', 'Karangjati'
            ],
            'Krembung' => [
                'Krembung', 'Bedrek', 'Karangklimpit', 'Winongan', 'Watukebo', 'Tlajung', 'Kedung Cowek',
                'Jambangan', 'Bedahejo', 'Krembung Wetan', 'Kemasan', 'Kamolankulon', 'Kamolanwetan',
                'Kampilan', 'Kandangan', 'Kandingan', 'Kandung', 'Kanji', 'Kanjuran', 'Kanoka'
            ],
            'Krian' => [
                'Krian', 'Jatisari', 'Wulung', 'Bedrek', 'Kemasan', 'Karangmulyo', 'Balongbendo', 'Kletek',
                'Jambangan', 'Kepul', 'Kepet', 'Kerakit', 'Keranggan', 'Keraton', 'Keratuan', 'Kerawang',
                'Keredan', 'Kereng', 'Kerengan', 'Keresan'
            ],
            'Wonoayu' => [
                'Wonoayu', 'Gajahpanjang', 'Kupang', 'Bokoharjo', 'Karanggeneng', 'Balongbendo', 'Candimulyo',
                'Kemasan', 'Banyumanik', 'Gajahan', 'Gajahpanjang', 'Gajapmulyo', 'Gajapan', 'Gajapel',
                'Gajaring', 'Gajarum', 'Gajasari', 'Gajasila', 'Gajasuno', 'Gajatela'
            ],
            'Tanggulangin' => [
                'Tanggulangin', 'Candimulyo', 'Balongsari', 'Jatisari', 'Kemasan', 'Kepuh Kiriman', 'Rangkah',
                'Kepuh Danan', 'Banyuagung', 'Belikurejo', 'Bekuang', 'Belimuran', 'Belingin', 'Belitung',
                'Belitungan', 'Belitungwetan', 'Belitungkuon', 'Belitungrejo', 'Belitungsari', 'Belitungwatu'
            ],
            'Candi' => [
                'Candi', 'Bedrek', 'Banyumanik', 'Griyorejo', 'Kedungmali', 'Pesanggrahan', 'Susukan',
                'Nglorog', 'Balungasin', 'Beduran', 'Bedrek', 'Bedrekan', 'Bedrejo', 'Bedreman', 'Bedrengan',
                'Bedrengot', 'Bedreson', 'Bedresuki', 'Bedretempo', 'Bedritama'
            ],
            'Sedati' => [
                'Sedati', 'Banjarsari', 'Gedangsari', 'Kamolankulon', 'Kamolanwetan', 'Kemayan', 'Ledokbanteng',
                'Tanjungsari', 'Banjarpolo', 'Banjarwedang', 'Bengkok', 'Benggala', 'Bengglis', 'Bengkara',
                'Bengkawan', 'Bengker', 'Bengkering', 'Bengkil', 'Bengkit', 'Bengkol'
            ],
            'Sutorejo' => [
                'Sutorejo', 'Badikan', 'Banjang', 'Bedrek', 'Gajahpanjang', 'Kemirikan', 'Melamaran',
                'Suromulyo', 'Banyulegundi', 'Bedulur', 'Bengkol', 'Bendul', 'Bendungan', 'Bener', 'Bengalas',
                'Bengaluh', 'Bengamit', 'Benganjing', 'Bengaro', 'Bengaroh'
            ],
            'Taman' => [
                'Taman', 'Bringin', 'Candi', 'Dawe', 'Gajahpanjang', 'Jetis', 'Randusari', 'Simoketawang',
                'Banaran', 'Bekas', 'Bendungan', 'Bengkoran', 'Bening', 'Bengkokan', 'Bengkulu', 'Bengtuma',
                'Bengkuang', 'Bengkuangsari', 'Bengkuwa', 'Bengkuyu'
            ],
            'Gedangan' => [
                'Gedangan', 'Alas Malang', 'Kemiri', 'Gisik Cemandi', 'Simbang', 'Watukebo', 'Wonoasri',
                'Rejo Agung', 'Banjarlegundi', 'Bedongan', 'Bendelan', 'Bendil', 'Bendul', 'Bening', 'Bengalas',
                'Bengaler', 'Bengaling', 'Bengamit', 'Bengar', 'Bengarah'
            ],
            'Waru' => [
                'Waru', 'Bedahan', 'Bungurasih', 'Kalijaten', 'Panggul', 'Parengan', 'Perbandungan', 'Tropodo',
                'Balintanya', 'Belenguyang', 'Benowo', 'Bengawan', 'Bengawal', 'Bengawasari', 'Bengawrejo',
                'Bengawu', 'Bengawul', 'Bengawulo', 'Bengawur', 'Bengawurejo'
            ],

            // JAWA TIMUR - PACITAN (9 Kecamatan)
            'Pacitan' => [
                'Pacitan', 'Astana', 'Banaran', 'Candirejo', 'Dukuh', 'Karangagung', 'Karangan', 'Kebumen',
                'Kologon', 'Krikilan', 'Kraton', 'Kuripan', 'Langkap', 'Pasir', 'Pelem', 'Pucuk', 'Purwosari',
                'Sengon', 'Slegi', 'Surodadi', 'Tambakroto', 'Tanjungsari', 'Tanjungsemi', 'Tanjungwangi',
                'Tejosari', 'Tempurejo', 'Terban', 'Tomesan', 'Watugajah', 'Winong'
            ],
            'Nawangan' => [
                'Nawangan', 'Beji', 'Bonyoh', 'Bulak', 'Burno', 'Centil', 'Danyudan', 'Datu', 'Dersono',
                'Jatisuko', 'Jero', 'Jimbasari', 'Jongkang', 'Joso', 'Kaseling', 'Kasreman', 'Kemalang',
                'Kendal', 'Kepet', 'Keryorejo', 'Kesamben', 'Kesem', 'Kesten', 'Ketangi'
            ],
            'Pringkuku' => [
                'Pringkuku', 'Adul', 'Ajung', 'Alasagung', 'Alasanbambang', 'Alasansari', 'Alas Bedug',
                'Alas Bendo', 'Alasing', 'Balong', 'Bangli', 'Bangsri', 'Bangwon', 'Banjarkawis',
                'Banjarlelok', 'Banjarwulan', 'Banjul', 'Banpet', 'Banyukuning', 'Banyuroto'
            ],
            'Arjosari' => [
                'Arjosari', 'Balong', 'Banaran', 'Bandung', 'Bangrejo', 'Banjir', 'Banjirejo', 'Banjirwetan',
                'Banjong', 'Bankal', 'Bantak', 'Bantal', 'Bantar', 'Bantarejo', 'Bantaranom', 'Bantarsari',
                'Bantarti', 'Bantartura', 'Bantarunduk', 'Bantarwulan'
            ],
            'Tembuku' => [
                'Tembuku', 'Temberejo', 'Tembeng', 'Tembengan', 'Tembenges', 'Tembesari', 'Tembesan',
                'Tembesari', 'Tembesul', 'Tembetas', 'Tembewan', 'Tembeyan', 'Tembeyer', 'Tembeyu',
                'Tembin', 'Tembing', 'Tembini', 'Tembit', 'Tembiyoso', 'Tembiyan'
            ],
            'Donorojo' => [
                'Donorojo', 'Badegan', 'Badegon', 'Badegowan', 'Badegur', 'Badegurejo', 'Badeguru', 'Badegus',
                'Badegungan', 'Badegung', 'Badegurejo', 'Badejan', 'Badejang', 'Badejaro', 'Badejati',
                'Badejelok', 'Badejengger', 'Badejenggo', 'Badejenis', 'Badejeruk'
            ],
            'Punung' => [
                'Punung', 'Balung', 'Balungasari', 'Balunggan', 'Balunggede', 'Balunggetah', 'Balunggo',
                'Balunggun', 'Balunghijo', 'Balungikang', 'Balunginar', 'Balunginum', 'Balungir', 'Balungirejo',
                'Balungisa', 'Balungisana', 'Balungisari', 'Balungisero', 'Balungisir', 'Balungita'
            ],
            'Gadu' => [
                'Gadu', 'Badang', 'Badangan', 'Badanganing', 'Badangarejo', 'Badangasari', 'Badangatem',
                'Badangati', 'Badangawu', 'Badangbesi', 'Badangbumen', 'Badangbunut', 'Badangdugul',
                'Badangduwet', 'Badangedal', 'Badangembang', 'Badangempas', 'Badangenak', 'Badangengon',
                'Badangepol'
            ],
            'Tulakan' => [
                'Tulakan', 'Bakung', 'Bakungdukuh', 'Bakungdukunan', 'Bakungdulur', 'Bakungduri', 'Bakungdurung',
                'Bakungduwet', 'Bakungembak', 'Bakungembala', 'Bakungembang', 'Bakungembat', 'Bakungembel',
                'Bakungembil', 'Bakungembong', 'Bakungembor', 'Bakungembuh', 'Bakungembur', 'Bakungender',
                'Bakungendro'
            ],

            // JAWA TIMUR - PONOROGO
            'Ponorogo' => [
                'Ponorogo', 'Banyudono', 'Dukuh', 'Jenangan', 'Jetis', 'Karangjati', 'Karangan', 'Kasreman',
                'Kebonsari', 'Kemiri', 'Keraton', 'Kleco', 'Kluwan', 'Kombang', 'Kramat', 'Kraton', 'Krikilan',
                'Krinting', 'Kronjo', 'Kruwo'
            ],
            'Jenangan' => [
                'Jenangan', 'Banaran', 'Bangun', 'Bangsring', 'Bangwon', 'Begajah', 'Bendungan', 'Bentar',
                'Bentem', 'Bentar', 'Benteng', 'Bering', 'Berjo', 'Berkas', 'Berkati', 'Berkuwo', 'Bermi',
                'Bermisono', 'Bernowo', 'Bersemi'
            ],
            'Ngrayun' => [
                'Ngrayun', 'Balong', 'Balongdowo', 'Balongduduk', 'Balongduga', 'Balongdukuh', 'Balongdukunan',
                'Balongdulur', 'Balongdumi', 'Balongdung', 'Balongdungul', 'Balongduwet', 'Balongembak',
                'Balongembang', 'Balongembat', 'Balongembel', 'Balongembil', 'Balongembong', 'Balongembor',
                'Balongembuh'
            ],
            'Ngebel' => [
                'Ngebel', 'Banaran', 'Banarenggo', 'Banarenggo', 'Banargondo', 'Banargowan', 'Banargumen',
                'Banargung', 'Banargungan', 'Banarguno', 'Banarguntur', 'Banargur', 'Banarguran', 'Banarguro',
                'Banarguron', 'Banargurup', 'Banarguru', 'Banargurusan', 'Banargurusno', 'Banargurusun'
            ],

            // DKI JAKARTA - JAKARTA PUSAT (7 Kelurahan per Kecamatan)
            'Cempaka Putih' => ['Cempaka Putih Barat', 'Cempaka Putih Timur', 'Cilandak', 'Cipinang', 'Cipete', 'Citayam', 'Ciputat'],
            'Johar Baru' => ['Johar Baru', 'Kramat', 'Kemayoran', 'Kemang', 'Kembangan', 'Kemboja', 'Kemulai'],
            'Kemayoran' => ['Kemayoran', 'Kebon Kelapa', 'Kebon Kosong', 'Kebon Nanas', 'Kebon Sirih', 'Kebon Timun', 'Kebon Timur'],
            'Menteng' => ['Menteng', 'Cikini', 'Gondangdia', 'Menteng Atas', 'Menteng Bawah', 'Menteng Dalam', 'Menteng Luar'],
            'Senen' => ['Senen', 'Bidara Cina', 'Kenari', 'Paseban', 'Pademangan', 'Pademangan Barat', 'Pademangan Timur'],
            'Tanah Abang' => ['Tanah Abang', 'Bendungan Hilir', 'Gelora', 'Petojo Utara', 'Petojo Selatan', 'Petojosan', 'Petojowetan'],

            // DKI JAKARTA - JAKARTA UTARA
            'Ancol' => ['Ancol', 'Kali Besar Barat', 'Kali Besar Timur', 'Kalideres', 'Kalidesari', 'Kalidesa', 'Kalidesa'],
            'Cilincing' => ['Cilincing', 'Penjaringan', 'Rorotan', 'Marunda', 'Muara Angke', 'Marundabaya', 'Marundasari'],
            'Kelapa Gading' => ['Kelapa Gading', 'Penjaringan Timur', 'Penjaringan Barat', 'Kelapa Gading Barat', 'Kelapa Gading Timur', 'Kelapa Muda', 'Kelapa Mulya'],
            'Penjaringan' => ['Penjaringan', 'Kedung Cowek', 'Pluit', 'Puri Safira', 'Puriwisata', 'Purilwisata', 'Purwisata'],
            'Pluit' => ['Pluit', 'Penjaringan Timur', 'Penjaringan Utara', 'Penjahitan', 'Penjaitan Barat', 'Penjaitan Timur', 'Penjaitan Utara'],
            'Tanjung Priok' => ['Tanjung Priok', 'Kebon Bawang', 'Kebon Kosong', 'Papanggo', 'Priok', 'Priok Utara', 'Priok Selatan'],

            // JAWA BARAT - BOGOR
            'Bogor Timur' => ['Cilangkap', 'Katulampa', 'Kertamaya', 'Tanahbaru', 'Tangki', 'Tanah Sareal', 'Tanjungsari'],
            'Bogor Barat' => ['Balumbang Jaya', 'Balumbang Lestari', 'Cilendek Barat', 'Cilendek Timur', 'Cilendek Sari', 'Cilendek Raya', 'Cilendek Baru'],
            'Bogor Utara' => ['Kebon Pedes', 'Kedung Halang', 'Kujangsari', 'Kujang Raya', 'Kujangwangi', 'Kujang Sari', 'Kujang Timur'],
            'Bogor Selatan' => ['Babakan', 'Babakan Pasar', 'Bantarjati', 'Cikiwul', 'Ciawi', 'Ciawi Barat', 'Ciawi Timur'],
            'Bogor Tengah' => ['Kebon Kelapa', 'Semeru', 'Tanah Sareal', 'Tanah Panjang', 'Tanah Tinggi', 'Tanah Datar', 'Tanah Baru'],
        ];

        // Insert desa data
        foreach ($dataLengkap as $kecamatanName => $desas) {
            $kecamatan = Kecamatan::where('nama_kecamatan', $kecamatanName)->first();
            
            if ($kecamatan) {
                foreach ($desas as $desaName) {
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

        $this->command->info('Desa comprehensive seeding completed successfully!');
    }
}
