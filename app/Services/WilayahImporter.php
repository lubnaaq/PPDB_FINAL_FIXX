<?php

namespace App\Services;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Symfony\Component\Console\Output\OutputInterface;

class WilayahImporter
{
    protected $output;

    public function __construct(OutputInterface $output = null)
    {
        $this->output = $output;
    }

    protected function log($message)
    {
        if ($this->output) {
            $this->output->writeln($message);
        }
    }

    /**
     * Import from CSV file (official dataset format)
     * CSV Format: provinsi_id, provinsi_name, kabupaten_id, kabupaten_name, kecamatan_id, kecamatan_name, desa_id, desa_name
     */
    public function importFromCsv($filePath)
    {
        $this->log("Importing from CSV: {$filePath}");
        
        if (!file_exists($filePath)) {
            $this->log("Error: File not found: {$filePath}");
            return false;
        }

        $file = fopen($filePath, 'r');
        if (!$file) {
            $this->log("Error: Could not open file: {$filePath}");
            return false;
        }

        // Skip header row
        $header = fgetcsv($file);
        
        $provinsiCount = 0;
        $kabupatenCount = 0;
        $kecamatanCount = 0;
        $desaCount = 0;
        $errorCount = 0;
        
        $provinsis = []; // cache by id
        $kabupatens = []; // cache by id
        $kecamatans = []; // cache by id

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) < 4) continue;
            
            $provinsi_id = (int) $row[0];
            $provinsi_name = trim($row[1] ?? '');
            $kabupaten_id = (int) $row[2];
            $kabupaten_name = trim($row[3] ?? '');
            $kecamatan_id = (int) ($row[4] ?? 0);
            $kecamatan_name = trim($row[5] ?? '');
            $desa_id = (int) ($row[6] ?? 0);
            $desa_name = trim($row[7] ?? '');
            
            // Validate basic data
            if ($provinsi_id <= 0 || empty($provinsi_name)) {
                $errorCount++;
                continue;
            }
            
            // Insert/Update Provinsi
            if (!isset($provinsis[$provinsi_id])) {
                try {
                    $provinsi = Provinsi::firstOrCreate(
                        ['id' => $provinsi_id],
                        ['nama_provinsi' => $provinsi_name]
                    );
                    $provinsis[$provinsi_id] = $provinsi;
                    $provinsiCount++;
                    $this->log("  Provinsi: {$provinsi_name}");
                } catch (\Exception $e) {
                    $this->log("    [Error] Provinsi {$provinsi_name}: " . $this->shortErr($e));
                    $errorCount++;
                    continue;
                }
            }
            
            // Insert/Update Kabupaten
            if ($kabupaten_id > 0 && !empty($kabupaten_name)) {
                if (!isset($kabupatens[$kabupaten_id])) {
                    try {
                        $kabupaten = Kabupaten::firstOrCreate(
                            ['id' => $kabupaten_id],
                            [
                                'provinsi_id' => $provinsi_id,
                                'nama_kabupaten' => $kabupaten_name,
                            ]
                        );
                        $kabupatens[$kabupaten_id] = $kabupaten;
                        $kabupatenCount++;
                        $this->log("    Kabupaten: {$kabupaten_name}");
                    } catch (\Exception $e) {
                        $this->log("      [Error] Kabupaten {$kabupaten_name}: " . $this->shortErr($e));
                        $errorCount++;
                    }
                }
            }
            
            // Insert/Update Kecamatan
            if ($kecamatan_id > 0 && !empty($kecamatan_name)) {
                if (!isset($kecamatans[$kecamatan_id])) {
                    try {
                        $kecamatan = Kecamatan::firstOrCreate(
                            ['id' => $kecamatan_id],
                            [
                                'kabupaten_id' => $kabupaten_id,
                                'nama_kecamatan' => $kecamatan_name,
                            ]
                        );
                        $kecamatans[$kecamatan_id] = $kecamatan;
                        $kecamatanCount++;
                    } catch (\Exception $e) {
                        $this->log("        [Kecamatan Error] {$kecamatan_name}: " . $this->shortErr($e));
                        $errorCount++;
                    }
                }
            }
            
            // Insert/Update Desa
            if ($desa_id > 0 && !empty($desa_name)) {
                try {
                    $desa = Desa::firstOrCreate(
                        ['id' => $desa_id],
                        [
                            'kecamatan_id' => $kecamatan_id,
                            'nama_desa' => $desa_name,
                        ]
                    );
                    $desaCount++;
                } catch (\Exception $e) {
                    $this->log("          [Desa Error] {$desa_name}: " . $this->shortErr($e));
                    $errorCount++;
                }
            }
        }
        
        fclose($file);
        
        $this->log("\n=== Import Summary ===");
        $this->log("Provinsi inserted/found: {$provinsiCount}");
        $this->log("Kabupaten inserted/found: {$kabupatenCount}");
        $this->log("Kecamatan inserted/found: {$kecamatanCount}");
        $this->log("Desa inserted/found: {$desaCount}");
        $this->log("Errors encountered: {$errorCount}");
        
        return true;
    }
    
    /**
     * Extract short error message (removes long queries)
     */
    protected function shortErr(\Exception $e)
    {
        $msg = $e->getMessage();
        if (strlen($msg) > 100) {
            return substr($msg, 0, 100) . '...';
        }
        return $msg;
    }
}
