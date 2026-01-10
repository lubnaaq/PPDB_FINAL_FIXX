<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'potongan',
        'aktif',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'aktif' => 'boolean',
        'potongan' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        $now = now();
        return $query->where('aktif', true)
                     ->whereDate('tanggal_mulai', '<=', $now)
                     ->whereDate('tanggal_selesai', '>=', $now);
    }
}
