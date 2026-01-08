<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        $biodata = $user->biodata;
        $jurusan = $biodata ? $biodata->jurusan : null;

        // Hitung total biaya (disamakan dengan logic JS: cutoff 31 Mei 2026)
        $totalBiaya = 0;
        $cutoffDate = \Carbon\Carbon::create(2026, 5, 31, 23, 59, 59);
        $now = \Carbon\Carbon::now();

        if ($jurusan) {
            if ($now->lte($cutoffDate)) {
                $totalBiaya = $jurusan->harga_gelombang_1;
            } else {
                $totalBiaya = $jurusan->harga_gelombang_2;
            }
        }

        // Hitung yang sudah dibayar (hanya verified)
        // Jika ada installment, kita sum amount
        $totalTerbayar = $payments->where('status', 'verified')->sum('amount');
        
        // Sisa tagihan
        $sisaTagihan = max(0, $totalBiaya - $totalTerbayar);
        
        // Cek status kepemilikan
        // Lunas jika sisa <= 0 dan ada pembayaran/tagihan > 0
        $isLunas = ($sisaTagihan <= 0 && $totalBiaya > 0);
        
        // Pending jika ada pembayaran status pending
        $hasPending = $payments->where('status', 'pending')->count() > 0;

        // Angsuran ke berapa (verified + 1)
        // Jika status rejected, user bisa upload ulang (dianggap angsuran ke-X yang sama, atau bisa edit)
        // Tapi jika form muncul, berarti ini entry baru, jadi count + 1
        $angsuranKe = $payments->where('status', 'verified')->count() + 1;

        return view('user.payment.index', compact(
            'payments', 
            'jurusan', 
            'totalBiaya', 
            'totalTerbayar', 
            'sisaTagihan', 
            'isLunas', 
            'hasPending',
            'angsuranKe'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1000',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:lunas,angsuran',
            'installment_count' => 'nullable|integer|min:2|max:6',
            'total_amount' => 'required|numeric',
            'installment_number' => 'nullable|integer',
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Validasi jika angsuran, harus ada installment_count
        if ($request->payment_method === 'angsuran' && !$request->installment_count) {
            return back()->with('error', 'Jumlah angsuran harus dipilih untuk metode angsuran.')->withInput();
        }

        try {
            $file = $request->file('proof_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('payments', $fileName, 'public');

            Payment::create([
                'user_id' => Auth::id(),
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'proof_file_path' => $filePath,
                'status' => 'pending',
                'notes' => $request->payment_method === 'angsuran' 
                    ? "Angsuran ke-{$request->installment_number} dari {$request->installment_count} (Total: Rp " . number_format($request->total_amount, 0, ',', '.') . ")"
                    : "Pembayaran Lunas",
            ]);

            $message = $request->payment_method === 'angsuran' 
                ? 'Bukti pembayaran angsuran ke-1 berhasil diunggah. Silakan upload angsuran berikutnya sesuai jadwal.'
                : 'Bukti pembayaran berhasil diunggah dan menunggu verifikasi.';

            return redirect()->route('user.payment.index')->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunggah bukti pembayaran: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Payment $payment)
    {
        // Validasi user
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        // Validasi status payment
        if ($payment->status === 'verified') {
            return back()->with('error', 'Pembayaran yang sudah diverifikasi tidak dapat diubah.');
        }

        $validator = Validator::make($request->all(), [
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            if ($request->hasFile('proof_file')) {
                // Hapus file lama jika ada
                if ($payment->proof_file_path && Storage::disk('public')->exists($payment->proof_file_path)) {
                    Storage::disk('public')->delete($payment->proof_file_path);
                }

                // Upload file baru
                $file = $request->file('proof_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('payments', $fileName, 'public');

                $payment->update([
                    'proof_file_path' => $filePath,
                    // Jika status sebelumnya 'rejected', kembalikan ke 'pending' agar bisa dicek ulang
                    'status' => 'pending', 
                ]);
            }

            return redirect()->route('user.payment.index')->with('success', 'Bukti pembayaran berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui bukti pembayaran: ' . $e->getMessage());
        }
    }

    public function printReceipt(Payment $payment)
    {
        // Pastikan pembayaran milik user yang sedang login
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan status pembayaran sudah verified
        if ($payment->status !== 'verified') {
            return back()->with('error', 'Kuitansi hanya dapat dicetak untuk pembayaran yang sudah diverifikasi.');
        }

        return view('user.payment.receipt', compact('payment'));
    }
}
