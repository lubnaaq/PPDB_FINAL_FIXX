<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WilayahImporter;

class ImportWilayah extends Command
{
    protected $signature = 'import:wilayah {filePath? : Path to CSV file} {--source=csv : Import source (csv)}';
    protected $description = 'Import provinsi/kabupaten/kecamatan/desa from CSV file';

    public function handle()
    {
        $this->info('Starting wilayah import...');
        
        $filePath = $this->argument('filePath');
        $source = $this->option('source');

        if (!$filePath) {
            // Default path if not provided
            $filePath = storage_path('app/wilayah-indonesia.csv');
        }

        if (!file_exists($filePath)) {
            $this->error("CSV file not found: {$filePath}");
            $this->info("Usage: php artisan import:wilayah /path/to/wilayah.csv");
            return 1;
        }

        $importer = new WilayahImporter($this->output);

        if ($source === 'csv') {
            $success = $importer->importFromCsv($filePath);
            if ($success) {
                $this->info('Import finished successfully.');
                return 0;
            } else {
                $this->error('Import failed.');
                return 1;
            }
        }

        $this->error('Unknown source: ' . $source);
        return 1;
    }
}
