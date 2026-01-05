<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDokumenController extends Controller
{
    /**
     * Display list of all documents for verification
     */
    public function index(Request $request)
    {
        $query = Dokumen::with('user')->orderBy('created_at', 'desc');
        $paymentQuery = Payment::with('user')->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status_verifikasi', $request->status);
            $paymentQuery->where('status', $request->status);
        }

        $dokumens = $query->paginate(15, ['*'], 'dokumen_page');
        $payments = $paymentQuery->paginate(15, ['*'], 'payment_page');

        return view('admin.verifikasi', compact('dokumens', 'payments'));
    }

    /**
     * Update verification status
     */
    public function updateStatus(Request $request, Dokumen $dokumen)
    {
        $validator = Validator::make($request->all(), [
            'status_verifikasi' => 'required|in:pending,disetujui,ditolak',
            'catatan_verifikasi' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $dokumen->update([
                'status_verifikasi' => $request->status_verifikasi,
                'catatan_verifikasi' => $request->catatan_verifikasi ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status verifikasi berhasil diperbarui'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get document details with user info
     */
    public function show(Dokumen $dokumen)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'dokumen' => $dokumen,
                'user' => $dokumen->user,
            ]
        ]);
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(Request $request, Payment $payment)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,verified,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $payment->update([
                'status' => $request->status,
                'notes' => $request->notes ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran berhasil diperbarui'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }
}
