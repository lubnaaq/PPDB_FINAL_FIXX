<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLaporanController extends Controller
{
    public function index()
    {
        // Statistik Utama
        $totalPendaftar = User::where('role', 'user')->count();
        $sudahIsiBiodata = Biodata::count();
        $sudahUploadDokumen = User::whereHas('dokumens')->count();
        $lulusSeleksi = Biodata::where('status_seleksi', 'lulus')->count();

        // Statistik Jenis Kelamin
        $jenisKelamin = Biodata::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        // Statistik Asal Sekolah (Top 5)
        $asalSekolah = Biodata::select('instansi', DB::raw('count(*) as total'))
            ->whereNotNull('instansi')
            ->groupBy('instansi')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Statistik Pendaftaran Harian (7 hari terakhir)
        $pendaftaranHarian = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('role', 'user')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Data untuk Tabel Ringkasan (Siswa Lulus)
        $siswaLulus = Biodata::with('user')
            ->where('status_seleksi', 'lulus')
            ->latest()
            ->get();

        return view('admin.laporan', compact(
            'totalPendaftar',
            'sudahIsiBiodata',
            'sudahUploadDokumen',
            'lulusSeleksi',
            'jenisKelamin',
            'asalSekolah',
            'pendaftaranHarian',
            'siswaLulus'
        ));
    }
}
