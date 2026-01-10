<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Payment;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDokumenController extends Controller
{
    /**
     * Display list of all documents for verification
     */
    public function index(Request $request)
    {
        // Eager load user and their payments to avoid N+1 in the view
        $query = Dokumen::with(['user.payments', 'user.biodata.kelas'])->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status_verifikasi', $request->status);
        }

        $dokumens = $query->paginate(15, ['*'], 'dokumen_page');

        return view('admin.verifikasi', compact('dokumens'));
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
            // Check logic for quota decrement
            if ($request->status === 'verified' && $payment->status !== 'verified') {
                $user = $payment->user;
                if ($user && $user->biodata && $user->biodata->jurusan_id) {
                    $jurusan = Jurusan::find($user->biodata->jurusan_id);
                    if ($jurusan && $jurusan->kuota > 0) {
                        $jurusan->decrement('kuota');
                    }
                }
            }
            
            // Logic for quota rollback (optional but good consistency)
            if ($payment->status === 'verified' && $request->status !== 'verified') {
                 $user = $payment->user;
                 if ($user && $user->biodata && $user->biodata->jurusan_id) {
                    $jurusan = Jurusan::find($user->biodata->jurusan_id);
                    if ($jurusan) {
                        $jurusan->increment('kuota');
                    }
                }
            }

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
