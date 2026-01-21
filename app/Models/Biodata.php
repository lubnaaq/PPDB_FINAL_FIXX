<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'biodatas';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'kode_pos',
        'nomor_telepon',
        'email',
        'asal_sekolah',
        'nisn',
        'hobi',
        'keterangan',
        'status_orang_tua',
        // Ayah
        'nama_ayah', 'nik_ayah', 'tahun_lahir_ayah', 'pekerjaan_ayah', 'pendidikan_ayah', 'penghasilan_ayah', 'no_hp_ayah',
        // Ibu
        'nama_ibu', 'nik_ibu', 'tahun_lahir_ibu', 'pekerjaan_ibu', 'pendidikan_ibu', 'penghasilan_ibu', 'no_hp_ibu',
        // Wali
        'nama_wali', 'nik_wali', 'tahun_lahir_wali', 'pekerjaan_wali', 'pendidikan_wali', 'penghasilan_wali', 'no_hp_wali',
        'jurusan_id',
        'kelas_id',
        'gelombang_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }
}

