<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\AdminDokumenController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminPengumumanController;
use App\Http\Controllers\AdminSeleksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatusController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact-us', function () {
    return view('contact');
});
Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');

Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');

Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.otp');
// Route yang hanya bisa diakses oleh user yang belum login
Route::middleware(['guest'])->group(
    function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');

        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');




        Route::get('/auth/{provider}', [AuthController::class, 'redirect'])->name('sso.redirect');
        Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('sso.callback');


        // Request reset link
        Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
        Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');

        // Reset password form
        Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');
    }
);


// Route yang hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/myprofile', function () {
        return view('myprofile');
    });

    // Shared routes (User & Admin)
    Route::get('/dokumen/{dokumen}/download', [DokumenController::class, 'download'])->name('dokumen.download');
    Route::get('/dokumen/{dokumen}/view', [DokumenController::class, 'viewFile'])->name('dokumen.view');

    // Admin routes
    Route::middleware(['cekRole:admin'])->group(function () {
        
        // Admin Jurusan Routes (Quota Management)
        Route::get('/jurusan-admin', [App\Http\Controllers\AdminJurusanController::class, 'index'])->name('admin.jurusan');
        Route::put('/jurusan-admin/{jurusan}', [App\Http\Controllers\AdminJurusanController::class, 'update'])->name('admin.jurusan.update');

        Route::get('/pendaftar', [App\Http\Controllers\AdminPendaftarController::class, 'index'])->name('admin.pendaftar');

        Route::get('/verifikasi', [AdminDokumenController::class, 'index'])->name('admin.verifikasi');
        Route::get('/dokumen/{dokumen}', [AdminDokumenController::class, 'show'])->name('admin.dokumen.show');
        Route::put('/dokumen/{dokumen}/status', [AdminDokumenController::class, 'updateStatus'])->name('admin.dokumen.updateStatus');
        
        // Admin Payment Routes (New)
        Route::get('/pembayaran', [App\Http\Controllers\AdminPembayaranController::class, 'index'])->name('admin.pembayaran');
        Route::put('/admin/payment/{payment}/status', [App\Http\Controllers\AdminPembayaranController::class, 'updateStatus'])->name('admin.payment.updateStatus');
        
        Route::get('/seleksi', [AdminSeleksiController::class, 'index'])->name('admin.seleksi');
        Route::put('/seleksi/{id}', [AdminSeleksiController::class, 'update'])->name('admin.seleksi.update');
        Route::get('/pengumuman', [AdminPengumumanController::class, 'index'])->name('admin.pengumuman');
        Route::post('/pengumuman', [AdminPengumumanController::class, 'update'])->name('admin.pengumuman.update');

        Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan');
        
            // Endpoint JSON untuk data laporan real-time (statistik + chart)
            Route::get('/laporan/data', function () {
                // Statistik ringkas
                $totalPendaftar = \App\Models\User::where('role', 'user')->count();
                $sudahIsiBiodata = \App\Models\User::where('role', 'user')->has('biodata')->count();
                $sudahUploadDokumen = \App\Models\Dokumen::distinct('user_id')->count('user_id');
                $lulusSeleksi = \App\Models\Biodata::where('status_seleksi', 'lulus')->count();
                $sudahBayar = \App\Models\Payment::where('status', 'verified')->count();
                $pembayaranPending = \App\Models\Payment::where('status', 'pending')->count();

                // Pendaftaran harian (7 hari terakhir)
                $pendaftaranHarian = \App\Models\User::selectRaw("DATE(created_at) as date, count(*) as total")
                    ->where('created_at', '>=', now()->subDays(6))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

                // Komposisi gender dari biodata
                $jenisKelaminRows = \App\Models\Biodata::select('jenis_kelamin', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                    ->groupBy('jenis_kelamin')
                    ->get();
                $jenisKelamin = [];
                foreach ($jenisKelaminRows as $r) {
                    $jenisKelamin[$r->jenis_kelamin] = (int) $r->total;
                }

                // Asal sekolah top 5
                $asalSekolah = \App\Models\Biodata::select('asal_sekolah', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                    ->groupBy('asal_sekolah')
                    ->orderByDesc('total')
                    ->limit(5)
                    ->get();

                // Siswa lulus (daftar singkat)
                $siswaLulus = \App\Models\Biodata::where('status_seleksi', 'lulus')
                    ->select('id', 'nama_lengkap', 'jenis_kelamin', 'asal_sekolah')
                    ->limit(50)
                    ->get();

                // Status verifikasi dokumen
                $statusVerifikasiRows = \App\Models\Dokumen::select('status_verifikasi', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                    ->groupBy('status_verifikasi')
                    ->get();
                $statusVerifikasi = [];
                foreach ($statusVerifikasiRows as $r) {
                    $statusVerifikasi[$r->status_verifikasi] = (int) $r->total;
                }

                // Status seleksi biodata
                $statusSeleksiRows = \App\Models\Biodata::select('status_seleksi', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                    ->groupBy('status_seleksi')
                    ->get();
                $statusSeleksi = [];
                foreach ($statusSeleksiRows as $r) {
                    $statusSeleksi[$r->status_seleksi] = (int) $r->total;
                }

                // Dokumen per tipe
                $dokumenPerTipe = \App\Models\Dokumen::select('nama_dokumen', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                    ->groupBy('nama_dokumen')
                    ->orderByDesc('total')
                    ->limit(10)
                    ->get();

                // Data Pembayaran Terbaru
                $dataPembayaran = \App\Models\Payment::with('user')
                    ->latest()
                    ->limit(10)
                    ->get();

                return response()->json([
                    'totalPendaftar' => $totalPendaftar,
                    'sudahIsiBiodata' => $sudahIsiBiodata,
                    'sudahUploadDokumen' => $sudahUploadDokumen,
                    'lulusSeleksi' => $lulusSeleksi,
                    'sudahBayar' => $sudahBayar,
                    'pembayaranPending' => $pembayaranPending,
                    'pendaftaranHarian' => $pendaftaranHarian,
                    'jenisKelamin' => $jenisKelamin,
                    'asalSekolah' => $asalSekolah,
                    'siswaLulus' => $siswaLulus,
                    'statusVerifikasi' => $statusVerifikasi,
                    'statusSeleksi' => $statusSeleksi,
                    'dokumenPerTipe' => $dokumenPerTipe,
                    'dataPembayaran' => $dataPembayaran,
                ]);
            })->name('admin.laporan.data');
    });

    // User routes
    Route::middleware(['cekRole:user'])->group(function () {

        Route::get('/biodata',  [BiodataController::class, 'index'])->name('user.biodata');
        Route::post('/biodata', [BiodataController::class, 'store'])->name('biodata.store');

        Route::get('/jurusan', [\App\Http\Controllers\JurusanController::class, 'index'])->name('user.jurusan');
        Route::post('/jurusan', [\App\Http\Controllers\JurusanController::class, 'store'])->name('user.jurusan.store');
        Route::post('/jurusan/cancel', [\App\Http\Controllers\JurusanController::class, 'cancel'])->name('user.jurusan.cancel');
        
        // API endpoints untuk cascading dropdown
        Route::get('/api/kabupaten/{provinsiId}', [BiodataController::class, 'getKabupaten'])->name('api.kabupaten');
        Route::get('/api/kecamatan/{kabupatenId}', [BiodataController::class, 'getKecamatan'])->name('api.kecamatan');
        Route::get('/api/desa/{kecamatanId}', [BiodataController::class, 'getDesa'])->name('api.desa');
        
        Route::get('/dokumen', [DokumenController::class, 'index'])->name('user.dokumen');
        Route::post('/dokumen', [DokumenController::class, 'store'])->name('dokumen.store');
        Route::delete('/dokumen/{dokumen}', [DokumenController::class, 'destroy'])->name('dokumen.destroy');
        
        Route::get('/status', [StatusController::class, 'index'])->name('user.status');
        Route::get('/hasil-pengumuman', [StatusController::class, 'pengumuman'])->name('user.hasil_pengumuman');
        Route::get('/daftar-ulang', function () {
            $user = auth()->user();
            $dokumens = \App\Models\Dokumen::where('user_id', $user->id)->get();
            
            // Get user's gelombang
            $registrationDate = $user->created_at ?? now();
            $userGelombang = \App\Models\Gelombang::whereDate('tanggal_mulai', '<=', $registrationDate)
                ->whereDate('tanggal_selesai', '>=', $registrationDate)
                ->first();
                
            if (!$userGelombang) {
                 $userGelombang = \App\Models\Gelombang::active()->first();
            }
            
            return view('user.daftar_ulang', compact('dokumens', 'userGelombang'));
        })->name('user.daftar_ulang');

        Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('user.payment.index');
        Route::post('/payment', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');
        Route::put('/payment/{payment}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payment.update');
        Route::get('/payment/{payment}/receipt', [App\Http\Controllers\PaymentController::class, 'printReceipt'])->name('payment.receipt');
    });
});
