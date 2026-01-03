# Panduan Cepat - Fitur Upload Dokumen SMK

## 📋 Ringkasan Fitur
Sistem upload dokumen lengkap untuk pendaftaran SMK dengan fitur verifikasi oleh admin.

## 🚀 Fitur Utama

### Untuk Pendaftar (User)
✅ Upload dokumen (Ijazah, NISN, KK, KTP, Akta, dll)
✅ Lihat status verifikasi dokumen
✅ Download dokumen yang sudah diupload
✅ Hapus dokumen (jika masih pending)
✅ Validasi format dan ukuran file client-side

### Untuk Admin
✅ Lihat semua dokumen yang diupload
✅ Filter berdasarkan status (Pending, Disetujui, Ditolak)
✅ Setujui atau tolak dokumen
✅ Tambahkan catatan verifikasi

## 📁 File yang Dibuat/Dimodifikasi

### Database
- ✅ `database/migrations/2026_01_03_000000_create_dokumens_table.php`

### Models
- ✅ `app/Models/Dokumen.php` (NEW)
- ✅ `app/Models/User.php` (UPDATE - tambah relationship)

### Controllers
- ✅ `app/Http/Controllers/DokumenController.php` (NEW)
- ✅ `app/Http/Controllers/AdminDokumenController.php` (NEW)

### Views
- ✅ `resources/views/user/dokumen.blade.php` (UPDATE)
- ✅ `resources/views/admin/verifikasi.blade.php` (UPDATE)

### Helpers & Config
- ✅ `app/Helpers/FileHelper.php` (NEW)
- ✅ `composer.json` (UPDATE - autoload)
- ✅ `routes/web.php` (UPDATE - routes)

## 🔧 Instalasi

```bash
# 1. Composer dump-autoload
composer dump-autoload

# 2. Jalankan Migration
php artisan migrate

# 3. Buat symbolic link untuk storage (opsional)
php artisan storage:link
```

## 📍 URL Endpoints

### User Routes
- `GET /dokumen` - Tampilkan form upload & daftar dokumen
- `POST /dokumen` - Upload dokumen
- `DELETE /dokumen/{id}` - Hapus dokumen
- `GET /dokumen/{id}/download` - Download dokumen

### Admin Routes
- `GET /verifikasi` - Tampilkan daftar verifikasi dokumen
- `GET /dokumen/{id}` - Lihat detail dokumen
- `PUT /dokumen/{id}/status` - Update status verifikasi

## 📊 Database Schema

```
Tabel: dokumens
- id (PK)
- user_id (FK) -> users
- nama_dokumen (string)
- file_path (string)
- file_type (string)
- file_size (bigInteger)
- status_verifikasi (enum: pending, disetujui, ditolak)
- catatan_verifikasi (text, nullable)
- timestamps (created_at, updated_at)
- deleted_at (soft delete)
```

## 🔐 Validasi & Security

### File Validation
- Format: PDF, JPG, JPEG, PNG
- Ukuran max: 5MB
- Server & client-side validation

### Security
- CSRF protection
- Authorization (user dapat manage dokumen sendiri)
- Soft delete untuk audit trail
- File stored di private folder

## 📝 Jenis Dokumen yang Didukung

1. Ijazah / SHUN
2. NISN
3. NPSN
4. Kartu Keluarga
5. KTP Orang Tua
6. Akta Kelahiran
7. Surat Keterangan Domisili
8. Surat Pernyataan Tidak Bekerja
9. Foto 3x4 (Warna Formal)
10. Surat Rekomendasi Kepala Sekolah
11. Dokumen Lainnya

## 🧪 Testing

### Manual Testing untuk User
1. Login sebagai user
2. Pergi ke menu "Upload Dokumen"
3. Pilih jenis dokumen dan file
4. Upload dan verifikasi tampilan

### Manual Testing untuk Admin
1. Login sebagai admin
2. Pergi ke menu "Verifikasi"
3. Filter dan lihat dokumen yang diupload
4. Test approve/reject dengan catatan

## 🐛 Troubleshooting

| Problem | Solution |
|---------|----------|
| Helper function tidak ditemukan | `composer dump-autoload` |
| File tidak tersimpan | Pastikan folder `storage/app/public` writable |
| CSRF error | Pastikan include CSRF token di form |
| Dokumen tidak bisa didownload | Jalankan `php artisan storage:link` |

## 📚 Dokumentasi Lengkap
Lihat file: `DOKUMEN_UPLOAD_FEATURE.md`

## 🎯 Next Steps (Opsional)
- [ ] Setup email notification untuk admin
- [ ] Implementasi document preview
- [ ] Bulk upload feature
- [ ] Document approval workflow
- [ ] Export laporan verifikasi
- [ ] OCR untuk validasi dokumen otomatis

---
**Status**: ✅ Fitur siap digunakan
**Terakhir update**: 3 Januari 2026
