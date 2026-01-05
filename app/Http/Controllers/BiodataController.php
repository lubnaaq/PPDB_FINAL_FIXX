<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
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
        $provinsis = Provinsi::all();

        return view('user.biodata', compact('is_verified_user', 'biodata', 'provinsis'));
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
            'nomor_telepon' => 'required|numeric|digits_between:10,15',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'provinsi_id' => 'required|string',
            'kabupaten_id' => 'required|string',
            'kecamatan_id' => 'required|string',
            'desa_id' => 'required|string',
            'kode_pos' => 'nullable|string|max:10',
            'asal_sekolah' => 'nullable|string|max:255',
            'nisn' => 'nullable|string|max:20',
            'hobi' => 'nullable|string|max:500',
            'keterangan' => 'nullable|string|max:1000',
        ];

        $validated = $request->validate($rules);

        // Hapus field yang tidak ada di database
        $data = collect($validated)->except(['provinsi', 'kota', 'kecamatan', 'kelurahan'])->toArray();
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

    /**
     * API: Get kabupaten by provinsi_id
     */
    public function getKabupaten($provinsiId)
    {
        $kabupatens = Kabupaten::where('provinsi_id', $provinsiId)->get();
        return response()->json($kabupatens);
    }

    /**
     * API: Get kecamatan by kabupaten_id
     */
    public function getKecamatan($kabupatenId)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupatenId)->get();
        return response()->json($kecamatans);
    }

    /**
     * API: Get desa by kecamatan_id
     */
    public function getDesa($kecamatanId)
    {
        $desas = Desa::where('kecamatan_id', $kecamatanId)->get();
        return response()->json($desas);
    }
}
