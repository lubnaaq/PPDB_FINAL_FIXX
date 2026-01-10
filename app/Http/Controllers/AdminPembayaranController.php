<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPembayaranController extends Controller
{
    /**
     * Display list of all payments for verification
     */
    public function index(Request $request)
    {
        $query = Payment::with(['user.biodata.kelas'])->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $payments = $query->paginate(15);

        return view('admin.pembayaran', compact('payments'));
    }

    /**
     * Update payment status
     */
    public function updateStatus(Request $request, Payment $payment)
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
            // Check logic for quota decrement AND Class Assignment
            if ($request->status === 'verified' && $payment->status !== 'verified') {
                $user = $payment->user;
                if ($user && $user->biodata && $user->biodata->jurusan_id) {
                    $jurusan = Jurusan::find($user->biodata->jurusan_id);
                    if ($jurusan) {
                        // NOTE: Quota decrement is now handled at selection phase (JurusanController)
                        // $jurusan->decrement('kuota'); 
                        
                        // Assign Class Logic
                        // Reuse the logic (duplicated for now, better to move to Service if reused often)
                        $jurusanId = $user->biodata->jurusan_id;
                        $counter = 1;
                        while(true) {
                             $namaKelas = $jurusan->kode . ' ' . $counter;
                             $kelas = Kelas::firstOrCreate(
                                 ['jurusan_id' => $jurusanId, 'nama_kelas' => $namaKelas],
                                 ['kapasitas' => 36, 'terisi' => 0]
                             );
                             
                             if ($kelas->terisi < $kelas->kapasitas) {
                                 $biodata = $user->biodata;
                                 $biodata->kelas_id = $kelas->id;
                                 $biodata->save();
                                 $kelas->increment('terisi');
                                 break;
                             }
                             $counter++;
                             if($counter > 100) break;
                        }
                    }
                }
            }
            
            // Logic for quota rollback (optional but good consistency)
            // NOTE: Quota rollback is now handled ONLY if user changes jurusan or manually handled. 
            // Cancelling payment shouldn't necessarily kick them out of the jurusan unless explicit.
            /* 
            if ($payment->status === 'verified' && $request->status !== 'verified') {
                 $user = $payment->user;
                 if ($user && $user->biodata && $user->biodata->jurusan_id) {
                    $jurusan = Jurusan::find($user->biodata->jurusan_id);
                    if ($jurusan) {
                        $jurusan->increment('kuota');
                    }
                }
            }
            */

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
