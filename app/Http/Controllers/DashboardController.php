<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $totalUsers = User::count();
            $totalPendaftar = User::where('role', 'user')->count();
            $totalDiterima = Biodata::where('status_seleksi', 'lulus')->count();
            $totalBiodata = Biodata::count();

            // Chart 1: Pendaftaran Harian (7 Hari Terakhir)
            $dailyRegistrations = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                ->where('role', 'user')
                ->where('created_at', '>=', now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            
            $chart1Dates = $dailyRegistrations->pluck('date')->toArray();
            $chart1Totals = $dailyRegistrations->pluck('total')->toArray();

            // Chart 2: Pendaftaran Bulanan (Tahun ini)
            $monthlyRegistrations = User::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                ->where('role', 'user')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();
            
            // Fill missing months with 0
            $chart2Data = [];
            for ($i = 1; $i <= 12; $i++) {
                $found = $monthlyRegistrations->firstWhere('month', $i);
                $chart2Data[] = $found ? $found->total : 0;
            }

            // Chart 3: Status Seleksi (Lulus vs Tidak Lulus vs Pending)
            $lulus = Biodata::where('status_seleksi', 'lulus')->count();
            $tidakLulus = Biodata::where('status_seleksi', 'tidak_lulus')->count();
            $pending = Biodata::where('status_seleksi', 'pending')->count();
            $chart3Data = [$lulus, $tidakLulus, $pending];

            return view('dashboard', compact(
                'totalUsers', 'totalPendaftar', 'totalDiterima', 'totalBiodata',
                'chart1Dates', 'chart1Totals',
                'chart2Data',
                'chart3Data'
            ));
        }

        return view('dashboard');
    }
}
