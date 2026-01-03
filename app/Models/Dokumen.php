<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokumen extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nama_dokumen',
        'file_path',
        'file_type',
        'file_size',
        'status_verifikasi',
        'catatan_verifikasi',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter berdasarkan status verifikasi
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_verifikasi', $status);
    }

    /**
     * Scope untuk filter dokumen user tertentu
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
