<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['jurusan_id', 'nama_kelas', 'kapasitas', 'terisi'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function biodatas()
    {
        return $this->hasMany(Biodata::class);
    }
}
