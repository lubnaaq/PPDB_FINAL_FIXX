# File Upload Feature untuk Pendaftaran SMK

## Overview
Fitur upload dokumen untuk pendaftaran Sekolah Menengah Kejuruan (SMK) yang memungkinkan calon siswa mengunggah dokumen-dokumen yang diperlukan dan admin untuk memverifikasi dokumen tersebut.

## Fitur Utama

### 1. **Upload Dokumen oleh Pendaftar**
- Pendaftar dapat mengunggah berbagai jenis dokumen
- Tipe file yang didukung: PDF, JPG, JPEG, PNG
- Ukuran maksimal file: 5MB
- Daftar dokumen yang dapat diunggah:
  - Ijazah / SHUN
  - NISN
  - NPSN
  - Kartu Keluarga
  - KTP Orang Tua
  - Akta Kelahiran
  - Surat Keterangan Domisili
  - Surat Pernyataan Tidak Bekerja
  - Foto 3x4 (Warna Formal)
  - Surat Rekomendasi Kepala Sekolah
  - Dokumen Lainnya

### 2. **Manajemen Dokumen**
- Pendaftar dapat melihat daftar dokumen yang sudah diunggah
- Pendaftar dapat mendownload dokumen mereka
- Pendaftar dapat menghapus dokumen yang masih status "pending"
- Status verifikasi dokumen: Pending, Disetujui, atau Ditolak

### 3. **Verifikasi oleh Admin**
- Admin dapat melihat daftar semua dokumen yang diunggah
- Admin dapat memfilter dokumen berdasarkan status verifikasi
- Admin dapat menyetujui atau menolak dokumen
- Admin dapat menambahkan catatan untuk setiap dokumen

## File yang Ditambahkan

### 1. **Database**
- `database/migrations/2026_01_03_000000_create_dokumens_table.php` - Migration untuk tabel dokumen

### 2. **Models**
- `app/Models/Dokumen.php` - Model untuk dokumen dengan relasi ke User

### 3. **Controllers**
- `app/Http/Controllers/DokumenController.php` - Controller untuk upload, download, dan delete dokumen
- `app/Http/Controllers/AdminDokumenController.php` - Controller untuk verifikasi dokumen

### 4. **Views**
- `resources/views/user/dokumen.blade.php` - View untuk form upload dan daftar dokumen pendaftar
- `resources/views/admin/verifikasi.blade.php` - View untuk admin verifikasi dokumen

### 5. **Helpers**
- `app/Helpers/FileHelper.php` - Helper function untuk format bytes

### 6. **Routes**
- Updated `routes/web.php` dengan routes baru untuk dokumen

## Database Schema

### Tabel: dokumens
```sql
- id (primary key)
- user_id (foreign key ke users)
- nama_dokumen (string) - nama jenis dokumen
- file_path (string) - path penyimpanan file
- file_type (string) - ekstensi file
- file_size (bigInteger) - ukuran file dalam bytes
- status_verifikasi (enum: pending, disetujui, ditolak)
- catatan_verifikasi (text) - catatan dari admin
- timestamps (created_at, updated_at)
- deleted_at (soft delete)
```

## API Endpoints

### User Routes
| Method | Route | Controller | Function |
|--------|-------|-----------|----------|
| GET | `/dokumen` | DokumenController | index |
| POST | `/dokumen` | DokumenController | store |
| DELETE | `/dokumen/{id}` | DokumenController | destroy |
| GET | `/dokumen/{id}/download` | DokumenController | download |

### Admin Routes
| Method | Route | Controller | Function |
|--------|-------|-----------|----------|
| GET | `/verifikasi` | AdminDokumenController | index |
| GET | `/dokumen/{id}` | AdminDokumenController | show |
| PUT | `/dokumen/{id}/status` | AdminDokumenController | updateStatus |

## Cara Penggunaan

### Untuk Pendaftar

1. **Login ke aplikasi**
   - Masuk ke dashboard pendaftar

2. **Akses Menu Upload Dokumen**
   - Klik menu "Upload Dokumen" di sidebar

3. **Upload Dokumen**
   - Pilih jenis dokumen dari dropdown
   - Pilih file dari komputer
   - Klik tombol "Upload Dokumen"

4. **Lihat Dokumen yang Sudah Diupload**
   - Dokumen akan ditampilkan dalam tabel
   - Status verifikasi akan ditampilkan untuk setiap dokumen

5. **Manage Dokumen**
   - Download dokumen dengan klik tombol download
   - Hapus dokumen (hanya jika masih pending) dengan klik tombol delete

### Untuk Admin

1. **Login ke aplikasi dengan role Admin**
   - Masuk ke dashboard admin

2. **Akses Menu Verifikasi Dokumen**
   - Klik menu "Verifikasi" di sidebar

3. **Filter Dokumen**
   - Gunakan filter untuk melihat dokumen berdasarkan status

4. **Verifikasi Dokumen**
   - Klik tombol preview untuk melihat dokumen
   - Pilih "Setujui" atau "Tolak"
   - Tambahkan catatan jika diperlukan

## Instalasi

1. **Copy files ke project**
   - Copy semua file yang telah dibuat ke struktur project yang sesuai

2. **Update composer.json**
   - Composer.json sudah diupdate dengan autoload helper

3. **Jalankan migration**
   ```bash
   php artisan migrate
   ```

4. **Dump autoload**
   ```bash
   composer dump-autoload
   ```

5. **Konfigurasi storage**
   - Pastikan folder `storage/app/public` dapat diakses
   - Jalankan: `php artisan storage:link`

## Validasi File

### Client-side Validation
- Format file: PDF, JPG, JPEG, PNG
- Maksimal ukuran: 5MB
- Minimum file harus dipilih

### Server-side Validation
- Validasi MIME type
- Validasi ukuran file
- Validasi ekstensi file

## Security Features

1. **Authorization**
   - User hanya bisa upload dokumen untuk diri sendiri
   - User hanya bisa download/delete dokumen milik mereka
   - Admin hanya bisa verify dokumen

2. **File Storage**
   - File disimpan di folder `storage/app/public/dokumen`
   - Soft delete untuk data dokumen

3. **CSRF Protection**
   - Semua form menggunakan CSRF token

## Error Handling

Aplikasi menangani error berikut:
- File terlalu besar
- Format file tidak didukung
- Field required tidak diisi
- Unauthorized access
- File tidak ditemukan (saat download)

## Peningkatan Masa Depan

1. Fitur preview dokumen untuk admin
2. Notifikasi email saat dokumen disetujui/ditolak
3. Bulk upload dokumen
4. Validasi dokumen menggunakan OCR
5. Export laporan verifikasi dokumen
6. Archive dokumen lama

## Troubleshooting

### File tidak tersimpan
- Pastikan folder `storage/app/public/dokumen` writeable
- Jalankan `php artisan storage:link`

### Helper function tidak terdefinisi
- Jalankan `composer dump-autoload`

### CSRF token error
- Pastikan header `X-CSRF-TOKEN` disertakan dalam request

## License
MIT
