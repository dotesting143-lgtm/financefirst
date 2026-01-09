<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportClientCreationDates extends Command
{
    protected $signature = 'app:import-client-creation-dates';
    protected $description = 'Import and update client creation dates from CSV';

    public function handle()
    {
        $csvPath = storage_path('app/importClientCreationDate.csv');

        if (!file_exists($csvPath)) {
            $this->error("❌ CSV file not found at: $csvPath");
            return 1;
        }

        if (($handle = fopen($csvPath, 'r')) === false) {
            $this->error("❌ Failed to open CSV file.");
            return 1;
        }

        $this->info("📄 Reading CSV file from: storage/app/importClientCreationDate.csv\n");

        $headerSkipped = false;
        $updatedCount = 0;
        $skippedCount = 0;

        while (($row = fgetcsv($handle)) !== false) {

            // Skip header row
            if (!$headerSkipped) {
                $headerSkipped = true;
                continue;
            }

            if (count($row) < 2) {
                $this->warn("⚠️ Skipped row (not enough columns): " . implode(',', $row));
                $skippedCount++;
                continue;
            }

            [$id, $dateString] = array_map('trim', $row);

            // Validate ID
            if (!is_numeric($id) || $id === '') {
                $this->warn("⚠️ Invalid ID in row: " . implode(',', $row));
                $skippedCount++;
                continue;
            }

            // Skip empty dates
            if (empty($dateString)) {
                $this->warn("⚠️ Skipped ID $id (empty date)");
                $skippedCount++;
                continue;
            }

            // Convert dd/mm/yyyy → datetime
            try {
                $date = Carbon::createFromFormat('d/m/Y', $dateString)->startOfDay();
            } catch (\Exception $e) {
                $this->error("❌ Invalid date format for ID $id: '$dateString'");
                $skippedCount++;
                continue;
            }

            // 🚫 Skip dates that are too old for TIMESTAMP (e.g. 1899-12-30)
            $minAllowed = Carbon::create(1970, 1, 1, 0, 0, 0);
            if ($date->lt($minAllowed)) {
                $this->warn("⚠️ Skipping ID $id — date {$date->format('Y-m-d H:i:s')} is before 1970-01-01 (likely invalid).");
                $skippedCount++;
                continue;
            }

            // Update DB
            try {
                $affected = DB::table('clients')
                    ->where('id', $id)
                    ->update([
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
            } catch (\Throwable $e) {
                $this->error("❌ Failed to update ID $id: " . $e->getMessage());
                $skippedCount++;
                continue;
            }

            if ($affected) {
                $this->info("✔️ Updated ID $id → {$date->format('Y-m-d H:i:s')}");
                $updatedCount++;
            } else {
                $this->warn("ℹ️ No matching client found for ID $id");
            }
        }

        fclose($handle);

        $this->line("\n---- SUMMARY ----");
        $this->info("✔️ Updated: $updatedCount");
        $this->warn("⚠️ Skipped: $skippedCount");
        $this->info("🎉 Import completed!");

        return 0;
    }
}
