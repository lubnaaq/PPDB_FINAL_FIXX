<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $is_verified_user = Auth::user()->is_verified; #class helper
        $biodata = Biodata::where('user_id', Auth::id())->first();

        return view('user.biodata', compact('is_verified_user', 'biodata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:30',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'provinsi' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'instansi' => 'nullable|string|max:255',
            'hobi' => 'nullable|string|max:500',
            'keterangan' => 'nullable|string|max:1000',
        ];

        $validated = $request->validate($rules);

        $data = $validated;
        $data['user_id'] = $userId;

        // Save or update biodata
        Biodata::updateOrCreate(
            ['user_id' => $userId],
            $data
        );

        return redirect()->route('user.biodata')->with('success', 'Biodata berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Biodata $biodata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biodata $biodata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biodata $biodata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biodata $biodata)
    {
        //
    }
}
