<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
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

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status_verifikasi', $request->status);
        }

        $dokumens = $query->paginate(15);

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
}
