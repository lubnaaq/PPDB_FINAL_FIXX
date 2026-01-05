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

        return view('user.payment.index', compact('payments', 'jurusan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1000',
            'payment_date' => 'required|date',
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('proof_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('payments', $fileName, 'public');

            Payment::create([
                'user_id' => Auth::id(),
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'proof_file_path' => $filePath,
                'status' => 'pending',
            ]);

            return redirect()->route('user.payment.index')->with('success', 'Bukti pembayaran berhasil diunggah dan menunggu verifikasi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunggah bukti pembayaran: ' . $e->getMessage());
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
