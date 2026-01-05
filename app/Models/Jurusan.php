<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
        'kuota',
        'harga_gelombang_1',
        'harga_gelombang_2',
        'gambar',
    ];

    public function biodatas()
    {
        return $this->hasMany(Biodata::class);
    }
}
