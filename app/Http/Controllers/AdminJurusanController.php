<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class AdminJurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::withCount('biodatas')->get();
        return view('admin.jurusan', compact('jurusans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kuota' => 'required|integer|min:0',
            // We can add more validations if we allow editing other fields
            'harga_gelombang_1' => 'nullable|numeric|min:0',
            'harga_gelombang_2' => 'nullable|numeric|min:0',
        ]);

        $jurusan = Jurusan::findOrFail($id);
        
        $jurusan->kuota = $request->kuota;
        
        if ($request->has('harga_gelombang_1')) {
            $jurusan->harga_gelombang_1 = $request->harga_gelombang_1;
        }
        
        if ($request->has('harga_gelombang_2')) {
            $jurusan->harga_gelombang_2 = $request->harga_gelombang_2;
        }

        $jurusan->save();

        return redirect()->back()->with('success', 'Data jurusan berhasil diperbarui.');
    }
}
