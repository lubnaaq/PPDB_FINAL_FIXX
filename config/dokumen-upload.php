<?php

/**
 * Konfigurasi File Upload Feature
 * File ini berisi konstanta dan konfigurasi yang dapat disesuaikan
 */

return [
    // Dokumen Types yang diizinkan
    'dokumen_types' => [
        'ijazah' => 'Ijazah / SHUN',
        'nisn' => 'NISN',
        'npsn' => 'NPSN',
        'kartu_keluarga' => 'Kartu Keluarga',
        'ktp_orang_tua' => 'KTP Orang Tua',
        'akta_kelahiran' => 'Akta Kelahiran',
        'surat_domisili' => 'Surat Keterangan Domisili',
        'surat_tidak_bekerja' => 'Surat Pernyataan Tidak Bekerja',
        'foto_3x4' => 'Foto 3x4 (Warna Formal)',
        'surat_rekomendasi' => 'Surat Rekomendasi Kepala Sekolah',
        'lainnya' => 'Dokumen Lainnya',
    ],

    // File validation rules
    'file' => [
        'max_size_mb' => 5, // Dalam MB
        'allowed_extensions' => ['pdf', 'jpg', 'jpeg', 'png'],
        'allowed_mimes' => ['application/pdf', 'image/jpeg', 'image/png'],
    ],

    // Penyimpanan
    'storage' => [
        'disk' => 'public', // public atau private
        'path' => 'dokumen', // Folder di dalam disk
    ],

    // Status verifikasi
    'verification_status' => [
        'pending' => 'Menunggu Verifikasi',
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
    ],

    // Pagination
    'pagination' => [
        'per_page' => 15,
    ],

    // Features
    'features' => [
        'enable_download' => true,
        'enable_delete' => true, // Hanya untuk dokumen pending
        'enable_preview' => false, // Coming soon
        'enable_bulk_upload' => false, // Coming soon
    ],

    // Email notifications
    'notifications' => [
        'notify_on_approval' => true,
        'notify_on_rejection' => true,
        'notify_admin_on_upload' => false,
    ],
];
