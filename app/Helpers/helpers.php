<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('formatBytes')) {
    /**
     * Format bytes to human readable format
     * 
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        if ($bytes == 0) {
            return '0 B';
        }
        
        $pow = floor(log($bytes) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('formatTanggal')) {
    /**
     * Format tanggal Indonesia
     * 
     * @param string $date
     * @param bool $withTime
     * @return string
     */
    function formatTanggal($date, $withTime = true) {
        if (!$date) {
            return '-';
        }
        
        $date = is_string($date) ? strtotime($date) : $date;
        
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        $timestamp = is_numeric($date) ? $date : strtotime($date);
        $day = date('w', $timestamp);
        $dateNum = date('j', $timestamp);
        $month = date('n', $timestamp);
        $year = date('Y', $timestamp);
        
        $result = $hari[$day] . ', ' . $dateNum . ' ' . $bulan[$month] . ' ' . $year;
        
        if ($withTime) {
            $result .= ' ' . date('H:i', $timestamp);
        }
        
        return $result;
    }
}

if (!function_exists('getFileIcon')) {
    /**
     * Get icon based on file type
     * 
     * @param string $fileType
     * @return string
     */
    function getFileIcon($fileType) {
        $icons = [
            'pdf' => 'fas fa-file-pdf text-danger',
            'doc' => 'fas fa-file-word text-primary',
            'docx' => 'fas fa-file-word text-primary',
            'xls' => 'fas fa-file-excel text-success',
            'xlsx' => 'fas fa-file-excel text-success',
            'jpg' => 'fas fa-file-image text-info',
            'jpeg' => 'fas fa-file-image text-info',
            'png' => 'fas fa-file-image text-info',
            'gif' => 'fas fa-file-image text-info',
            'zip' => 'fas fa-file-archive text-warning',
            'rar' => 'fas fa-file-archive text-warning',
        ];
        
        $ext = strtolower($fileType);
        return $icons[$ext] ?? 'fas fa-file text-secondary';
    }
}