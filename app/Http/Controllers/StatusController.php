<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Dokumen;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * Menampilkan halaman status pendaftaran dengan data dinamis
     */
    public function index()
    {
        $user = Auth::user();
        
        // Hitung persentase kelengkapan biodata
        $biodataPercentage = $this->calculateBiodataPercentage($user->id);
        
        // Hitung persentase kelengkapan dokumen
        $dokumenPercentage = $this->calculateDokumenPercentage($user->id);
        
        // Ambil data dokumen yang sudah diupload
        $dokumens = Dokumen::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Hitung status verifikasi dokumen
        $dokumenStats = [
            'total' => $dokumens->count(),
            'disetujui' => $dokumens->where('status_verifikasi', 'disetujui')->count(),
            'ditolak' => $dokumens->where('status_verifikasi', 'ditolak')->count(),
            'pending' => $dokumens->where('status_verifikasi', 'pending')->count(),
        ];

        // Dokumen yang diperlukan
        $requiredDocuments = [
            'Ijazah',
            'NISN',
            'Kartu Keluarga',
            'Akta Kelahiran',
            'Surat Keterangan Domisili',
            'Foto 3x4',
        ];

        // Dokumen yang sudah diupload (unique)
        $uploadedDocuments = $dokumens->pluck('nama_dokumen')->unique()->toArray();
        
        // Dokumen yang masih kurang
        $missingDocuments = array_diff($requiredDocuments, $uploadedDocuments);
        
        // Tentukan status berkas keseluruhan
        $statusBerkas = $this->determineOverallStatus($dokumenStats);
        
        // Ambil biodata jika ada
        $biodata = Biodata::where('user_id', $user->id)->first();
        
        return view('user.status', compact(
            'user',
            'biodata',
            'biodataPercentage',
            'dokumenPercentage',
            'dokumens',
            'dokumenStats',
            'statusBerkas',
            'requiredDocuments',
            'uploadedDocuments',
            'missingDocuments'
        ));
    }

    /**
     * Hitung persentase kelengkapan biodata
     */
    private function calculateBiodataPercentage($userId)
    {
        $biodata = Biodata::where('user_id', $userId)->first();
        
        if (!$biodata) {
            return 0;
        }

        // List field yang wajib diisi
        $requiredFields = [
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'alamat',
            'kabupaten_id',
            'provinsi_id',
            'kecamatan_id',
            'desa_id',
            'asal_sekolah',
            'nisn',
            'kode_pos',
            'nomor_telepon',
            'email',
        ];

        $filledFields = 0;

        foreach ($requiredFields as $field) {
            if (!empty($biodata->$field)) {
                $filledFields++;
            }
        }

        // Hitung persentase
        $percentage = round(($filledFields / count($requiredFields)) * 100);

        return min($percentage, 100);
    }

    /**
     * Hitung persentase kelengkapan dokumen
     */
    private function calculateDokumenPercentage($userId)
    {
        $dokumens = Dokumen::where('user_id', $userId)->get();

        // Dokumen minimum yang diperlukan
        $requiredDocuments = [
            'Ijazah',
            'NISN',
            'Kartu Keluarga',
            'Akta Kelahiran',
            'Surat Keterangan Domisili',
            'Foto 3x4',
        ];

        $uploadedDocuments = $dokumens->pluck('nama_dokumen')->unique()->toArray();
        
        $uploadedCount = 0;
        foreach ($requiredDocuments as $doc) {
            if (in_array($doc, $uploadedDocuments)) {
                $uploadedCount++;
            }
        }

        // Hitung persentase
        $percentage = round(($uploadedCount / count($requiredDocuments)) * 100);

        return min($percentage, 100);
    }

    /**
     * Tentukan status berkas keseluruhan berdasarkan dokumen
     */
    private function determineOverallStatus($dokumenStats)
    {
        if ($dokumenStats['total'] === 0) {
            return [
                'status' => 'belum_upload',
                'label' => 'Belum Ada Dokumen',
                'color' => 'secondary',
                'icon' => 'icon-inbox',
                'description' => 'Silakan upload dokumen pendaftaran Anda'
            ];
        }

        if ($dokumenStats['ditolak'] > 0 && $dokumenStats['disetujui'] === 0) {
            return [
                'status' => 'ada_ditolak',
                'label' => 'Ada Dokumen Ditolak',
                'color' => 'danger',
                'icon' => 'icon-x-circle',
                'description' => 'Ada dokumen yang ditolak. Silakan upload ulang dokumen yang ditolak.'
            ];
        }

        if ($dokumenStats['pending'] > 0 && $dokumenStats['ditolak'] === 0) {
            return [
                'status' => 'menunggu_verifikasi',
                'label' => 'Menunggu Verifikasi',
                'color' => 'warning',
                'icon' => 'icon-clock',
                'description' => 'Dokumen Anda sedang diverifikasi oleh admin'
            ];
        }

        if ($dokumenStats['disetujui'] > 0 && $dokumenStats['ditolak'] === 0 && $dokumenStats['pending'] === 0) {
            return [
                'status' => 'semua_disetujui',
                'label' => 'Semua Dokumen Disetujui',
                'color' => 'success',
                'icon' => 'icon-check-circle',
                'description' => 'Semua dokumen Anda sudah diverifikasi dan disetujui'
            ];
        }

        return [
            'status' => 'sedang_proses',
            'label' => 'Sedang Diproses',
            'color' => 'info',
            'icon' => 'icon-shuffle',
            'description' => 'Dokumen Anda sedang dalam proses verifikasi'
        ];
    }

    public function pengumuman()
    {
        $user = Auth::user();
        $biodata = Biodata::with('kelas', 'jurusan')->where('user_id', $user->id)->first();
        
        $announcementOpen = Setting::where('key', 'announcement_open')->value('value');
        $announcementDate = Setting::where('key', 'announcement_date')->value('value');

        $status_kelulusan = 'BELUM_DIBUKA';

        if ($announcementOpen) {
            if ($biodata) {
                if ($biodata->status_seleksi == 'lulus') {
                    $status_kelulusan = 'LULUS';
                } elseif ($biodata->status_seleksi == 'tidak_lulus') {
                    $status_kelulusan = 'TIDAK LULUS';
                } else {
                    $status_kelulusan = 'PENDING'; // Masih diproses meski pengumuman buka
                }
            } else {
                $status_kelulusan = 'PENDING';
            }
        }

        return view('user.hasil_pengumuman', compact('status_kelulusan', 'announcementDate', 'biodata'));
    }
}
