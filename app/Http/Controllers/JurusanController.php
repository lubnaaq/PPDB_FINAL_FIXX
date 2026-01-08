<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Biodata;
use App\Models\Payment;
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

        return view('user.jurusan', compact('jurusans', 'selectedJurusanId', 'hasPayment', 'isVerified', 'hasBiodata'));
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

        $biodata->jurusan_id = $request->jurusan_id;
        $biodata->save();

        return redirect()->route('user.jurusan')->with('success', 'Jurusan berhasil dipilih.');
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
