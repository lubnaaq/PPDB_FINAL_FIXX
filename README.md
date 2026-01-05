# 📂 Aplikasi PPDB – UKK 2526

> **Progress Terakhir:** Implementasi **SSO Login** untuk autentikasi pengguna ✅

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/Status-Development-orange.svg" alt="Status">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
</p>

## 📋 Tentang Proyek

**Aplikasi PPDB** adalah platform web berbasis **Laravel 12.x** untuk mengelola pendaftaran siswa baru secara online.

### 🎯 Fitur Utama
- ✅ Registrasi & Login (termasuk **SSO**)
- ✅ Formulir pendaftaran online
- ✅ Upload & verifikasi dokumen
- ⏳ Seleksi & pengumuman hasil
- ⏳ Daftar ulang & pelaporan

### 👥 Pengguna
| Role | Fungsi |
|------|--------|
| **Calon Siswa/Orang Tua** | Isi form, upload dokumen, cek hasil |
| **Admin Operator** | Verifikasi data, kelola jadwal, pengumuman |

## 🚀 Cara Menjalankan

```bash
# Clone branch development
git clone --branch aplikasi_ppdb --single-branch https://github.com/riskiputraalamzah/ukk_2526.git aplikasi_ppdb
cd aplikasi_ppdb

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Jalankan migrasi & seed
php artisan migrate --seed

# Start server
php artisan serve

Akses aplikasi: http://127.0.0.1:8000

```
###🛠️ Requirements
- PHP 8.2+

- Composer

- MySQL/MariaDB

- Node.js & NPM (untuk assets)

📁 Struktur Project
```
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Notifications/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
└── routes/
```
###📊 Status Development

- ✅ SSO Login (Selesai)
- ✅ Basic Auth
- ✅ Form Pendaftaran
- ⏳ Verifikasi Dokumen
- ⏳ Pengumuman Hasil
- ⏳ Dashboard Admin

Author: Lubna Aqila Salsabil
Repository: https://github.com/lubnaaq/PPDB-FINAL
