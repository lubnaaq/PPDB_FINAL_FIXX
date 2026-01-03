<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSeleksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Biodata::with(['user', 'user.dokumens']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status_seleksi', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nomor_telepon', 'like', "%{$search}%");
            });
        }

        $biodatas = $query->paginate(10);

        return view('admin.seleksi', compact('biodatas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_seleksi' => 'required|in:pending,lulus,tidak_lulus'
        ]);

        $biodata = Biodata::findOrFail($id);
        $biodata->status_seleksi = $request->status_seleksi;
        $biodata->save();

        return redirect()->back()->with('success', 'Status seleksi berhasil diperbarui.');
    }
}
