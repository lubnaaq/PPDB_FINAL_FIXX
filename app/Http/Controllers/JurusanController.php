<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Biodata;
use App\Models\Payment;
use App\Models\Kelas;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        $user = Auth::user();
        $biodata = $user->biodata;
        $selectedJurusanId = $biodata ? $biodata->jurusan_id : null;

        // Cek apakah user sudah verifikasi email
        // Prioritaskan check is_verified karena AuthController menggunakan flag ini
        $isVerified = $user->is_verified == 1 || $user->email_verified_at !== null;

        // Cek kelengkapan biodata (simple check: apakah record ada)
        $hasBiodata = $biodata !== null;

        // Cek apakah user sudah melakukan pembayaran (pending atau verified)
        $hasPayment = Payment::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'verified'])
            ->exists();
        
        $hasVerifiedPayment = Payment::where('user_id', $user->id)
            ->where('status', 'verified')
            ->exists();

        // Self-healing: Assign class if missed (Verified + Major + No Class)
        if ($hasVerifiedPayment && $selectedJurusanId && $biodata && !$biodata->kelas_id) {
            $this->assignKelas($biodata, $selectedJurusanId);
            $biodata->refresh();
        }

        // Determine Gelombang based on user registration date
        $registrationDate = $user->created_at ?? now();
        $userGelombang = Gelombang::whereDate('tanggal_mulai', '<=', $registrationDate)
            ->whereDate('tanggal_selesai', '>=', $registrationDate)
            ->first();

        // Fallback: If no wave matches registration date, look for currently active wave
        if (!$userGelombang) {
            $userGelombang = Gelombang::active()->first();
        }

        return view('user.jurusan', compact('jurusans', 'selectedJurusanId', 'hasPayment', 'isVerified', 'hasBiodata', 'biodata', 'userGelombang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $user = Auth::user();
        
        // Enforce validations
        // Check both is_verified flag and email_verified_at timestamp
        if ($user->is_verified != 1 && $user->email_verified_at === null) {
             return redirect()->route('user.jurusan')->with('error', 'Silakan verifikasi akun email Anda terlebih dahulu.');
        }

        $biodata = $user->biodata;

        if (!$biodata) {
            return redirect()->route('user.biodata')->with('error', 'Silakan isi biodata terlebih dahulu.');
        }

        $oldJurusanId = $biodata->jurusan_id;

        // Validation for Availability
        $newJurusan = Jurusan::find($request->jurusan_id);
        if ($oldJurusanId != $request->jurusan_id && $newJurusan->kuota <= 0) {
             return redirect()->back()->with('error', 'Mohon maaf, kuota jurusan ini sudah penuh.');
        }

        $biodata->jurusan_id = $request->jurusan_id;

        // Assign Active Gelombang if available and not yet paid
        $hasVerifiedPayment = Payment::where('user_id', $user->id)
            ->where('status', 'verified')
            ->exists();

        if (!$hasVerifiedPayment) {
            $activeGelombang = Gelombang::active()->first();
            if ($activeGelombang) {
                $biodata->gelombang_id = $activeGelombang->id;
            }
        }

        $biodata->save();

        // --- Quota Management (Moved to Selection) ---
        if ($oldJurusanId != $request->jurusan_id) {
            // Decrement new quota
            if ($newJurusan) {
                $newJurusan->decrement('kuota');
            }
            
            // Increment old quota
            if ($oldJurusanId) {
                $oldJurusan = Jurusan::find($oldJurusanId);
                if ($oldJurusan) {
                    $oldJurusan->increment('kuota');
                }
            }
        }

        // --- Class Assignment (Only if Paid) ---
        if ($hasVerifiedPayment) {
            // --- Assign Class Logic ---
            $this->assignKelas($biodata, $request->jurusan_id);
        }

        return redirect()->route('user.jurusan')->with('success', 'Jurusan berhasil dipilih.');
    }
    
    /**
     * Helper to auto-assign student to a class based on capacity
     */
    private function assignKelas($biodata, $jurusanId)
    {
        $jurusan = Jurusan::find($jurusanId);
        if (!$jurusan) return;

        // Loop to find or create class with available slot
        $counter = 1;
        while (true) {
             $namaKelas = $jurusan->kode . ' ' . $counter; // e.g. TKR 1
             
             // Find or create the class
             // We use firstOrCreate so it's thread-safe enough for low traffic
             $kelas = Kelas::firstOrCreate(
                 ['jurusan_id' => $jurusanId, 'nama_kelas' => $namaKelas],
                 ['kapasitas' => 36, 'terisi' => 0]
             );

             // Check capacity
             if ($kelas->terisi < $kelas->kapasitas) {
                 // Assign student
                 $biodata->kelas_id = $kelas->id;
                 $biodata->save();

                 // Update class count
                 $kelas->increment('terisi');
                 break;
             }

             // If full, increment counter and try next class (TKR 2, TKR 3, etc)
             $counter++;
             
             // Safety break to prevent infinite loops in weird edge cases
             if ($counter > 100) break; 
        }
    }

    public function cancel()
    {
        $user = Auth::user();
        
        // Cek pembayaran sebelum cancel
        $hasPayment = Payment::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'verified'])
            ->exists();

        if ($hasPayment) {
            return redirect()->route('user.jurusan')->with('error', 'Anda tidak dapat membatalkan jurusan karena sudah melakukan pembayaran.');
        }

        $biodata = $user->biodata;

        if ($biodata) {
            $biodata->jurusan_id = null;
            $biodata->save();
            return redirect()->route('user.jurusan')->with('success', 'Pilihan jurusan berhasil dibatalkan.');
        }

        return redirect()->route('user.jurusan')->with('error', 'Biodata tidak ditemukan.');
    }
}
