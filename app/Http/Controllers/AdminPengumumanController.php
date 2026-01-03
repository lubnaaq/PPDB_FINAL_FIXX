<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminPengumumanController extends Controller
{
    public function index()
    {
        // Ambil setting pengumuman
        $announcementOpen = Setting::where('key', 'announcement_open')->value('value');
        $announcementDate = Setting::where('key', 'announcement_date')->value('value');

        // Statistik
        $stats = [
            'total' => Biodata::count(),
            'lulus' => Biodata::where('status_seleksi', 'lulus')->count(),
            'tidak_lulus' => Biodata::where('status_seleksi', 'tidak_lulus')->count(),
            'pending' => Biodata::where('status_seleksi', 'pending')->count(),
        ];

        // Daftar siswa yang lulus (untuk preview/cetak)
        $lulusStudents = Biodata::where('status_seleksi', 'lulus')->get();

        return view('admin.pengumuman', compact('announcementOpen', 'announcementDate', 'stats', 'lulusStudents'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'announcement_open' => 'required|in:0,1',
            'announcement_date' => 'required|date',
        ]);

        Setting::updateOrCreate(
            ['key' => 'announcement_open'],
            ['value' => $request->announcement_open]
        );

        Setting::updateOrCreate(
            ['key' => 'announcement_date'],
            ['value' => $request->announcement_date]
        );

        return redirect()->back()->with('success', 'Pengaturan pengumuman berhasil diperbarui.');
    }
}
