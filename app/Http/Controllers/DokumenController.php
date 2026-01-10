<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DokumenController extends Controller
{
    /**
     * Display list of user's documents
     */
    public function index()
    {
        $user = Auth::user();
        $dokumens = Dokumen::byUser($user->id)->orderBy('created_at', 'desc')->get();
        
        return view('user.dokumen', compact('dokumens', 'user'));
    }

    /**
     * Store uploaded document
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // max 5MB
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Store file in public/dokumen directory
            $filePath = $file->storeAs('dokumen', $fileName, 'public');

            // Create dokumen record
            $dokumen = Dokumen::create([
                'user_id' => Auth::id(),
                'nama_dokumen' => $request->nama_dokumen,
                'file_path' => $filePath,
                'file_type' => strtolower($file->getClientOriginalExtension()),
                'file_size' => $file->getSize(),
                'status_verifikasi' => 'pending',
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Dokumen berhasil diunggah',
                    'data' => $dokumen
                ], 201);
            }
            return redirect()->route('user.dokumen')->with('success', 'Dokumen berhasil diunggah dan menunggu verifikasi.');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengunggah dokumen: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Gagal mengunggah dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Delete document
     */
    public function destroy(Dokumen $dokumen)
    {
        // Check if user owns this document
        if ($dokumen->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin menghapus dokumen ini'
            ], 403);
        }

        try {
            // Delete file from storage
            if (Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            // Delete dokumen record
            $dokumen->delete();

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus dokumen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download document
     */
    public function download(Dokumen $dokumen)
    {
        // Check if user owns this document or is admin
        if ($dokumen->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($dokumen->file_path);
    }

    /**
     * View document inline
     */
    public function viewFile(Dokumen $dokumen)
    {
        // Check if user owns this document or is admin
        if ($dokumen->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $file = Storage::disk('public')->path($dokumen->file_path);
        
        return response()->file($file);
    }
}
