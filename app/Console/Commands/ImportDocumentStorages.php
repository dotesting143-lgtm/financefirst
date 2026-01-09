<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportDocumentStorages extends Command
{
    protected $signature = 'document-storages:import';
    protected $description = 'Import document records into document_storages table from CSV in storage/app/document_storage_sample.csv';

    public function handle(): int
    {
        $path = storage_path('app/document_storage_s2.csv');

        if (! file_exists($path)) {
            $this->error("CSV file not found at: {$path}");
            return Command::FAILURE;
        }

        if (($handle = fopen($path, 'r')) === false) {
            $this->error("Unable to open the CSV file.");
            return Command::FAILURE;
        }

        $header = fgetcsv($handle);
        $header = array_map(fn($h) => strtolower(trim($h)), $header);

        $batchSize = 500;
        $batch = [];
        $total = 0;
        $inserted = 0;
        $skipped = 0;

        $this->info("📥 Importing records from CSV...");
        $start = microtime(true);

        while (($row = fgetcsv($handle)) !== false) {
            $total++;
            $data = array_combine($header, $row);

            // ✅ read id from CSV
            $csvId = isset($data['id']) && is_numeric($data['id'])
                ? (int) $data['id']
                : null;

            // if no id in csv, skip (or you can auto-assign)
            if ($csvId === null) {
                $skipped++;
                continue;
            }

            // if this id already exists, skip to avoid duplicate key
            $exists = DB::table('document_storages')->where('id', $csvId)->exists();
            if ($exists) {
                $skipped++;
                continue;
            }

            $title        = $data['title'] ?? null;
            $filename     = $data['filename'] ?? null;
            $clientIdRaw  = $data['client_id'] ?? null;
            $createdAtRaw = $data['created_at'] ?? null;
            $uploadedBy   = $data['uploaded_by'] ?? null;

            // ✅ client_id: 0 -> null
            $clientId = is_numeric($clientIdRaw) ? (int) $clientIdRaw : null;
            if (empty($clientId) || $clientId === 0) {
                $clientId = null;
            }

            // ✅ build download link
            $downloadLink = $filename
                ? "/storage/uploads/documents/{$filename}"
                : null;

            // ✅ parse created_at
            try {
                $createdAt = Carbon::createFromFormat('d/m/Y H:i:s', $createdAtRaw);
            } catch (\Throwable $e) {
                $createdAt = now();
            }

            $batch[] = [
                'id'            => $csvId,
                'title'         => $title,
                'filename'      => $filename,
                'uploaded_by'   => $uploadedBy,
                'client_id'     => $clientId,
                'download_link' => $downloadLink,
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ];

            // ✅ insert every 500
            if (count($batch) === $batchSize) {
                DB::table('document_storages')->insert($batch);
                $inserted += count($batch);
                $this->line("✅ Inserted {$inserted} records so far... (skipped: {$skipped})");
                $batch = [];
            }
        }

        // ✅ insert remaining
        if (count($batch)) {
            DB::table('document_storages')->insert($batch);
            $inserted += count($batch);
        }

        fclose($handle);

        $duration = round(microtime(true) - $start, 2);
        $this->info("✅ Import complete!");
        $this->info("➡️ Total rows in CSV: {$total}");
        $this->info("➡️ Inserted: {$inserted}");
        $this->info("➡️ Skipped (existing/missing id): {$skipped}");
        $this->info("⏱️ Time: {$duration} seconds");

        return Command::SUCCESS;
    }
}
