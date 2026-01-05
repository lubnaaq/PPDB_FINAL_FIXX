<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provinsi;
use App\Models\Kabupaten;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Aceh' => [
                'Aceh Selatan', 'Aceh Tenggara', 'Aceh Timur', 'Aceh Tengah', 'Aceh Barat',
                'Aceh Utara', 'Aceh Besar', 'Pidie', 'Pidie Jaya', 'Bireuen', 'Simeulue'
            ],
            'Sumatera Utara' => [
                'Nias', 'Mandailing Natal', 'Tapanuli Selatan', 'Tapanuli Tengah', 'Tapanuli Utara',
                'Toraja Utara', 'Asahan', 'Simalungun', 'Dairi', 'Karo', 'Deli Serdang', 'Langkat',
                'Nias Utara', 'Nias Barat'
            ],
            'Sumatera Barat' => [
                'Pesisir Selatan', 'Solok', 'Sawahlunto/Sijunjung', 'Tanah Datar', 'Padang Pariaman',
                'Agam', 'Lima Puluh Kota', 'Pasaman', 'Pasaman Barat'
            ],
            'Riau' => [
                'Kuantan Singingi', 'Indragiri Hulu', 'Indragiri Hilir', 'Palalawan', 'Sri Indrapura',
                'Siak', 'Kampar', 'Rokan Hilir', 'Rokan Hulu', 'Bengkalis', 'Kepulauan Meranti'
            ],
            'Jambi' => [
                'Kerinci', 'Merangin', 'Sarolangun', 'Batanghari', 'Muaro Jambi', 'Tanjung Jabung Timur',
                'Tanjung Jabung Barat', 'Tebo'
            ],
            'Sumatera Selatan' => [
                'Ogan Komering Ulu', 'Ogan Komering Ilir', 'Muara Enim', 'Lahat', 'Musi Rawas',
                'Musi Banyuasin', 'Banyuasin'
            ],
            'Bengkulu' => [
                'Seluma', 'Bengkulu Utara', 'Kaur', 'Kepahiang', 'Lebong', 'Muko-Muko', 'Rejang Lebong'
            ],
            'Lampung' => [
                'Lampung Barat', 'Tanggamus', 'Lampung Selatan', 'Lampung Timur', 'Lampung Tengah',
                'Way Kanan', 'Tulang Bawang', 'Pesisir Barat'
            ],
            'Kepulauan Bangka Belitung' => [
                'Bangka', 'Belitung', 'Bangka Barat', 'Bangka Tengah', 'Bangka Selatan', 'Belitung Timur'
            ],
            'Kepulauan Riau' => [
                'Bintan', 'Karimun', 'Natuna', 'Lingga', 'Anambas'
            ],
            'DKI Jakarta' => [
                'Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur'
            ],
            'Jawa Barat' => [
                'Bogor', 'Sukabumi', 'Cianjur', 'Bandung', 'Garut', 'Tasikmalaya', 'Ciamis',
                'Kuningan', 'Cirebon', 'Majalengka', 'Sumedang', 'Indramayu', 'Subang', 'Purwakarta',
                'Karawang', 'Bekasi', 'Bandung Barat'
            ],
            'Jawa Tengah' => [
                'Cilacap', 'Banyumas', 'Purbalingga', 'Banjarnegara', 'Kebumen', 'Purworejo', 'Magelang',
                'Wonosobo', 'Temanggung', 'Kendal', 'Semarang', 'Demak', 'Kudus', 'Jepara', 'Rembang',
                'Pati', 'Blora', 'Kraton', 'Grobogan', 'Ngawi', 'Magetan', 'Ponorogo', 'Pacitan',
                'Wonogiri', 'Sukoharjo', 'Karanganyar', 'Sragen', 'Klaten'
            ],
            'DI Yogyakarta' => [
                'Kulon Progo', 'Bantul', 'Gunung Kidul', 'Sleman'
            ],
            'Jawa Timur' => [
                'Pacitan', 'Ponorogo', 'Trenggalek', 'Tulungagung', 'Blitar', 'Kediri', 'Malang',
                'Lumajang', 'Jember', 'Banyuwangi', 'Bondowoso', 'Situbondo', 'Probolinggo', 'Pasuruan',
                'Sidoarjo', 'Mojokerto', 'Jombang', 'Nganjuk', 'Madiun', 'Magetan', 'Ngawi', 'Bojonegoro',
                'Tuban', 'Lamongan', 'Gresik', 'Bangkalan', 'Sampang', 'Pamekasan', 'Sumenep'
            ],
            'Banten' => [
                'Pandeglang', 'Lebak', 'Tangerang', 'Serang'
            ],
            'Bali' => [
                'Jembrana', 'Tabanan', 'Badung', 'Gianyar', 'Klungkung', 'Bangli', 'Buleleng', 'Karangasem'
            ],
            'Nusa Tenggara Barat' => [
                'Lombok Utara', 'Lombok Tengah', 'Lombok Timur', 'Lombok Barat', 'Sumbawa', 'Sumbawa Barat', 'Dompu', 'Bima'
            ],
            'Nusa Tenggara Timur' => [
                'Kupang', 'Timor Tengah Utara', 'Timor Tengah Selatan', 'Timor Leste', 'Belu', 'Alor', 'Lembata',
                'Flores Timur', 'Ende', 'Ngada', 'Manggarai', 'Rote Ndao', 'Manggarai Barat', 'Sumba Timur', 'Sumba Barat'
            ],
            'Kalimantan Barat' => [
                'Mempawah', 'Sambas', 'Bengkayang', 'Landak', 'Pontianak', 'Sanggau', 'Sekadau', 'Sintang', 'Kapuas Hulu', 'Kayong Utara'
            ],
            'Kalimantan Tengah' => [
                'Kotawaringin Barat', 'Kotawaringin Timur', 'Kapuas', 'Barito Utara', 'Barito Timur', 'Barito Selatan', 'Sukamara', 'Lamandau', 'Gunung Mas', 'Murung Raya'
            ],
            'Kalimantan Selatan' => [
                'Tanah Laut', 'Kotabaru', 'Banjar', 'Barito Kuala', 'Tapin', 'Hulu Sungai Selatan', 'Hulu Sungai Tengah', 'Hulu Sungai Utara'
            ],
            'Kalimantan Timur' => [
                'Pasir', 'Kutai Barat', 'Kutai Kartanegara', 'Berau', 'Penajam Paser Utara'
            ],
            'Kalimantan Utara' => [
                'Bulungan', 'Tana Tidung', 'Nunukan', 'Malinau'
            ],
            'Sulawesi Utara' => [
                'Bolaang Mongondow', 'Minahasa', 'Kepulauan Sangihe', 'Kepulauan Talaud', 'Minahasa Utara', 'Bolaang Mongondow Utara', 'Minahasa Tenggara'
            ],
            'Sulawesi Tengah' => [
                'Banggai', 'Poso', 'Donggala', 'Toli-Toli', 'Buol', 'Parigi Moutong', 'Tojo Una-Una', 'Banggai Kepulauan'
            ],
            'Sulawesi Selatan' => [
                'Selayar', 'Bulukumba', 'Bantaeng', 'Jeneponto', 'Takalar', 'Gowa', 'Sinjai', 'Maros',
                'Pangkajene dan Kepulauan', 'Barru', 'Bone', 'Soppeng', 'Wajo', 'Sidenreng Rappang', 'Pinrang', 'Enrekang', 'Luwu', 'Tana Toraja', 'Luwu Utara', 'Luwu Timur'
            ],
            'Sulawesi Tenggara' => [
                'Buton', 'Muna', 'Konawe', 'Kolaka', 'Bombana', 'Wakatobi', 'Konawe Utara', 'Buton Utara'
            ],
            'Gorontalo' => [
                'Boalemo', 'Bone Bolango', 'Gorontalo', 'Pohuwato'
            ],
            'Sulawesi Barat' => [
                'Mamasa', 'Polewali Mandar', 'Mamuju', 'Majene'
            ],
            'Maluku' => [
                'Maluku Tengah', 'Maluku Tenggara', 'Buru', 'Seram Bagian Barat', 'Seram Bagian Timur', 'Maluku Tenggara Barat', 'Kepulauan Aru', 'Buru Selatan'
            ],
            'Maluku Utara' => [
                'Halmahera Barat', 'Halmahera Tengah', 'Halmahera Utara', 'Halmahera Selatan', 'Kepulauan Sula', 'Morotai', 'Pulau Taliabu'
            ],
            'Papua' => [
                'Merauke', 'Jayawijaya', 'Jayapura', 'Nabire', 'Kepulauan Yapen', 'Biak Numfor', 'Waropen',
                'Supiori', 'Mamberamo Raya', 'Sarmi', 'Keerom', 'Pegunungan Bintang', 'Tolikara', 'Sarmi',
                'Sentani', 'Manokwari'
            ],
            'Papua Barat' => [
                'Sorong', 'Raja Ampat', 'Manokwari Selatan', 'Wondama', 'Teluk Wondama', 'Teluk Bintuni', 'Fakfak'
            ],
        ];

        foreach ($data as $provinsiName => $kabupatens) {
            $provinsi = Provinsi::where('nama_provinsi', $provinsiName)->first();
            
            if ($provinsi) {
                foreach ($kabupatens as $kabupatenName) {
                    Kabupaten::firstOrCreate(
                        [
                            'provinsi_id' => $provinsi->id,
                            'nama_kabupaten' => $kabupatenName
                        ],
                        [
                            'provinsi_id' => $provinsi->id,
                            'nama_kabupaten' => $kabupatenName
                        ]
                    );
                }
            }
        }
    }
}
