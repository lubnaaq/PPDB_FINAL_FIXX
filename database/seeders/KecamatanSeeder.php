<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kabupaten;
use App\Models\Kecamatan;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Jawa Timur' => [
                'Pacitan' => ['Pacitan', 'Nawangan', 'Pringkuku', 'Arjosari', 'Tembuku', 'Donorojo', 'Punung', 'Gadu', 'Tulakan'],
                'Ponorogo' => ['Ponorogo', 'Jenangan', 'Ngrayun', 'Ngebel', 'Siman', 'Sampung', 'Slahung', 'Balong', 'Badegan', 'Sambit', 'Wagir', 'Sooko'],
                'Trenggalek' => ['Trenggalek', 'Karangan', 'Kali', 'Temayang', 'Panggul', 'Munjungan', 'Pogalan', 'Durenan', 'Gandusomo', 'Kampak', 'Watulimo'],
                'Tulungagung' => ['Tulungagung', 'Besuki', 'Boyolangu', 'Rejotangan', 'Ngantru', 'Karangrejo', 'Sumbergempol', 'Bandung', 'Pakel', 'Kedungwaru', 'Pucuk'],
                'Blitar' => ['Blitar', 'Bakung', 'Binangun', 'Gandusari', 'Kesamben', 'Nglegok', 'Kademangan', 'Kanigoro', 'Sanankulon', 'Wonotirto', 'Talun'],
                'Kediri' => ['Kediri', 'Banyakan', 'Grogol', 'Mojo', 'Ngasem', 'Puncu', 'Sawahan', 'Plosoklaten', 'Nongkojajar', 'Wates', 'Kampak'],
                'Malang' => ['Malang', 'Ampelgading', 'Donomulyo', 'Gedangan', 'Kalipare', 'Kasembon', 'Kromengan', 'Madapangga', 'Sumbermanjing Wetan', 'Sumberlawang', 'Tirtoyudo', 'Turen', 'Bululawang', 'Dampit', 'Bantur', 'Candi', 'Pujon', 'Jabung', 'Ngajum'],
                'Lumajang' => ['Lumajang', 'Balung', 'Yosowilangun', 'Klakah', 'Sumbersari', 'Sumbermujur', 'Jatirejo', 'Thoriqul Huda', 'Pasirian', 'Senduro', 'Tekung', 'Pronojiwo'],
                'Jember' => ['Jember', 'Sukorambi', 'Kencong', 'Rembang', 'Semboro', 'Sumbersari', 'Ambulu', 'Panti', 'Balung', 'Mumbulsari', 'Tabanan', 'Tanggul', 'Ajung', 'Mayang', 'Bangsalsari', 'Puger', 'Wuluhan', 'Jenggawah', 'Gumukmas', 'Silo', 'Tempurejo', 'Patrang'],
                'Banyuwangi' => ['Banyuwangi', 'Singojuruh', 'Rogojampi', 'Songgon', 'Tegalsari', 'Banyuputih', 'Glagah', 'Purwoharjo', 'Licin', 'Muncar', 'Pesanggaran', 'Giri', 'Kalibaru', 'Getol', 'Kabat', 'Cluring', 'Bangoredjo', 'Sumbersewu', 'Wongsorejo', 'Sempu', 'Srono'],
                'Bondowoso' => ['Bondowoso', 'Binajam', 'Tanjungsari', 'Bondowoso', 'Cermee', 'Maesan', 'Wonosari', 'Sukosari', 'Ijen'],
                'Situbondo' => ['Situbondo', 'Panarukan', 'Besuki', 'Bumi Aji', 'Mlandingan', 'Suboh', 'Sariwangi', 'Jatibanteng', 'Arjasa', 'Balung'],
                'Probolinggo' => ['Probolinggo', 'Sumber', 'Gading', 'Sukapura', 'Kuripan', 'Kraksaan', 'Lumbang', 'Tongas', 'Wonomerto', 'Pajarakan', 'Banteng', 'Nglanding', 'Tinutukan'],
                'Pasuruan' => ['Pasuruan', 'Bangil', 'Grati', 'Pandaan', 'Sukorejo', 'Purwodadi', 'Purwosari', 'Rembang', 'Winongan', 'Gondang Wetan', 'Wonorejo', 'Kejayan', 'Lekok', 'Sukodono', 'Ngoro', 'Tutur', 'Puspo', 'Prigen'],
                'Sidoarjo' => ['Sidoarjo', 'Buduran', 'Porong', 'Jabon', 'Krembung', 'Krian', 'Wonoayu', 'Tanggulangin', 'Candi', 'Sedati', 'Sutorejo', 'Taman', 'Gedangan', 'Waru'],
                'Mojokerto' => ['Mojokerto', 'Punggol', 'Bangsal', 'Sooko', 'Pacet', 'Puri', 'Gedeg', 'Kemlagi', 'Trawas', 'Ngoro'],
                'Jombang' => ['Jombang', 'Joambang', 'Kudu', 'Mojoagung', 'Mojowarno', 'Ploso', 'Gudo', 'Diwek', 'Perak', 'Plandaan', 'Kabuh', 'Ngusikan', 'Bareng', 'Tembelang'],
                'Nganjuk' => ['Nganjuk', 'Nganjuk', 'Gondang', 'Sukomoro', 'Loceret', 'Lengkong', 'Barreng', 'Tanjungsari', 'Wilangan', 'Rejoso', 'Pace', 'Patianraja', 'Suromenggal'],
                'Madiun' => ['Madiun', 'Dagangan', 'Dolopo', 'Geger', 'Gemarang', 'Jiwan', 'Kebonsari', 'Mejayan', 'Saradan', 'Sawahan', 'Wonoasih'],
                'Magetan' => ['Magetan', 'Barat', 'Bendo', 'Karas', 'Karangwetan', 'Lembeyan', 'Magetan', 'Maospati', 'Panekan', 'Parang', 'Kawedanan', 'Sukowiryo', 'Takeran'],
                'Ngawi' => ['Ngawi', 'Bringin', 'Geneng', 'Karanganyar', 'Kasreman', 'Mantingan', 'Ngrampal', 'Nyoman', 'Pangkur', 'Pitu', 'Pungkuk', 'Sine', 'Widodaren'],
                'Bojonegoro' => ['Bojonegoro', 'Balen', 'Bubulan', 'Dander', 'Gondang', 'Jatikalen', 'Kanor', 'Kapas', 'Kasiman', 'Kedewan', 'Kemiri', 'Ngambon', 'Ngraho', 'Padangan', 'Purwosari', 'Sumberrejo', 'Temayang', 'Margomulyo'],
                'Tuban' => ['Tuban', 'Bangil', 'Bogorejo', 'Butuh', 'Grabagan', 'Jatirogo', 'Jenu', 'Kenduruan', 'Merakurak', 'Montong', 'Palang', 'Plumpang', 'Rengel', 'Semanding', 'Soko', 'Sumoroto', 'Tambakboyo', 'Tuban', 'Singgahan', 'Kerek'],
                'Lamongan' => ['Lamongan', 'Babat', 'Bluluk', 'Brondong', 'Deket', 'Glagah', 'Kalitengah', 'Karanggeneng', 'Kedungpring', 'Kembangbahu', 'Lamongan', 'Laren', 'Mantup', 'Ngimbang', 'Paciran', 'Pucuk', 'Sambas', 'Sarirejo', 'Sekaran', 'Senori', 'Sugio', 'Sukodadi', 'Sumberrejo', 'Telogo', 'Turi'],
                'Gresik' => ['Gresik', 'Batu', 'Cerme', 'Duduk Sampeyan', 'Driyorejo', 'Gresik', 'Kedamean', 'Menganti', 'Mojokerto', 'Panceng', 'Petanahan', 'Sangkapura', 'Sidayu', 'Ujung Pancur'],
                'Bangkalan' => ['Bangkalan', 'Arosbaya', 'Blega', 'Galis', 'Glagah', 'Kamal', 'Klampis', 'Konang', 'Kwanyar', 'Labang', 'Modung', 'Sepulu', 'Socah', 'Spanjer', 'Tanjung Bumi', 'Tragah'],
                'Sampang' => ['Sampang', 'Aenganyar', 'Ardimulyo', 'Camplong', 'Jrengik', 'Karang Penang', 'Ketapang', 'Omben', 'Pangarangan', 'Pandalungan', 'Robatal'],
                'Pamekasan' => ['Pamekasan', 'Batumarmar', 'Batu Putih', 'Galis', 'Larangan', 'Pademawu', 'Pakong', 'Palengaan', 'Pamekasan', 'Pegantenan', 'Proppo', 'Waru'],
                'Sumenep' => ['Sumenep', 'Arjasa', 'Batang-batang', 'Dasuk', 'Dungkak', 'Ganding', 'Giligenteng', 'Gumuk', 'Kalianget', 'Kangayan', 'Kota Sumenep', 'Lenteng', 'Masalembu', 'Nonggunong', 'Pragaan', 'Saronggi', 'Talango', 'Talentang']
            ],
            'Jawa Barat' => [
                'Bogor' => ['Bogor Timur', 'Bogor Barat', 'Bogor Utara', 'Bogor Selatan', 'Bogor Tengah', 'Cibinong', 'Cigudeg', 'Cijeruk', 'Cileungsi', 'Caringin', 'Cariu', 'Citeureup', 'Cibungbulang', 'Ciampea', 'Dramaga', 'Gunung Putri', 'Kemang', 'Nambo', 'Parung', 'Parung Panjang', 'Ranca Bungur', 'Rumpin', 'Sukaraja', 'Sukasari', 'Tajurhalang', 'Tamansari', 'Tanjungsari', 'Teluk Jambe', 'Teluk Jambe Timur', 'Teluk Jambe Barat', 'Tenjo'],
            ],
            'DKI Jakarta' => [
                'Jakarta Pusat' => ['Cempaka Putih', 'Johar Baru', 'Kemayoran', 'Menteng', 'Mrantapan', 'Senen', 'Tanah Abang'],
                'Jakarta Utara' => ['Ancol', 'Cilincing', 'Kelapa Gading', 'Penjaringan', 'Pluit', 'Tanjung Priok'],
                'Jakarta Barat' => ['Cengkareng', 'Grogol Petamburan', 'Jakasampurna', 'Kebon Jeruk', 'Palmerah', 'Penjaringan', 'Taman Sari', 'Tambora'],
                'Jakarta Selatan' => ['Cilandak', 'Kebayoran Baru', 'Kebayoran Lama', 'Krukut', 'Mampang Prapatan', 'Pasar Minggu', 'Pesanggrahan', 'Setiabudi'],
                'Jakarta Timur' => ['Cakung', 'Ciracas', 'Cipayung', 'Ciputat', 'Jatinegara', 'Kramat Jati', 'Makasar', 'Pulo Gadung', 'Rawamangun', 'Tebet'],
            ]
        ];

        foreach ($data as $provinsi => $kabupatens) {
            foreach ($kabupatens as $kabupaten => $kecamatans) {
                $kabupatenModel = Kabupaten::where('nama_kabupaten', $kabupaten)->first();
                
                if ($kabupatenModel) {
                    foreach ($kecamatans as $kecamatan) {
                        Kecamatan::firstOrCreate(
                            [
                                'kabupaten_id' => $kabupatenModel->id,
                                'nama_kecamatan' => $kecamatan
                            ],
                            [
                                'kabupaten_id' => $kabupatenModel->id,
                                'nama_kecamatan' => $kecamatan
                            ]
                        );
                    }
                }
            }
        }
    }
}
