<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProductNotes;
use League\Csv\Reader;

class ImportProductNotesFromCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-product-notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = storage_path('app/product-notes-new_s5.csv');

        if (!file_exists($filePath)) {
            $this->error("File not found at: {$filePath}");
            return 1;
        }

        $this->info("Starting import from: {$filePath}");

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // Assumes the first row contains headers
        $records = $csv->getRecords();
        $a = 1;

        $batchSize = 100; // Adjust batch size
        $batch = [];
        $total = iterator_count($records);
        $processed = 0;

        foreach ($records as $record) {
            // Map CSV fields to database columns
            $batch[] = [
                'id' => $a++,
                'note_id' => $record['note_id'],
                'first_name' => $record['firstname'] ?? null,
                'last_name' => $record['lastname'] ?? null,
                'created_by' => $record['created_by'] ?? null,
                'assigned_to' => $record['assigned_to'] ?? null,
                'subject' => $record['subject'] ?? null,
                'text' => $record['text'] ?? null,
                'active' => $record['active'] ?? null,
                'policy_type' => $record['policy_type'] ?? null,
                'policy_id' => $record['policy_id'] ?? null,
                'reminder_id' => $record['reminder_id'] ?? null,
                'reminder_date' => $this->normalizeDate($record['reminder_date']) ?? null,
                'reminder_to' => $record['reminder_to'] ?? null,
                'created_at' => $this->normalizeDate($record['created_at']) ?? null,
                'updated_at' => $this->normalizeDate($record['updated_at']) ?? null,
            ];

            $processed++;

            if (count($batch) === $batchSize) {
                $this->insertBatch($batch);
                $batch = [];
                $this->info("Processed {$processed}/{$total} records...");
            }
        }

        if (!empty($batch)) {
            $this->insertBatch($batch);
        }

        $this->info("Import completed successfully! Total records: {$total}");
        return 0;
    }

    private function insertBatch(array $batch)
    {
        try {
            ProductNotes::insert($batch);
        } catch (\Exception $e) {
            $this->error("Error inserting batch: " . $e->getMessage());
            \Log::error($e->getMessage(), ['batch' => $batch]);
        }
    }

    private function validateDate($date, $inputFormat = 'd/m/Y', $outputFormat = 'Y-m-d')
	{
	    if (empty($date)) {
	        return null;
	    }

	    $parsedDate = \DateTime::createFromFormat($inputFormat, $date);
	    return $parsedDate ? $parsedDate->format($outputFormat) : null;
	}

	private function validateNumeric($value)
	{
	    return is_numeric(trim($value)) ? $value : null;
	}

    private function normalizeDate($value): ?string
    {
        // 1) Normalize input & fast-exits
        if ($value === null) return null;
        $v = is_string($value) ? str_replace("\xC2\xA0", ' ', $value) : $value; // remove NBSP
        $v = is_string($v) ? trim($v) : $v;

        if ($v === '' || $v === '0000-00-00' || $v === '0' || $v === '-') {
            return null;
        }

        // 2) Excel serial (numeric)
        if (is_numeric($v)) {
            $n = (float)$v;
            if ($n > 0) {
                // Excel 1900 system with leap-bug offset (base 1899-12-30)
                $base = new \DateTimeImmutable('1899-12-30');
                $dt = $base->modify('+' . (int)round($n) . ' days');
                if ($dt && (int)$dt->format('Y') >= 1900) {
                    return $dt->format('Y-m-d');
                }
            }
            return null;
        }

        // 3) Try common textual formats
        $formats = [
            'Y-m-d',  // 2025-10-29
            'd/m/Y',  // 29/10/2025
            'd-m-Y',  // 29-10-2025
            'm/d/Y',  // 10/29/2025
            'd/m/y',  // 29/10/25
            'd-m-y',  // 29-10-25
            'm/d/y',  // 10/29/25
        ];

        foreach ($formats as $fmt) {
            $dt = \DateTime::createFromFormat($fmt, $v);
            if ($dt instanceof \DateTime) {
                // Guard: getLastErrors() may return false on some PHP versions
                $errors = \DateTime::getLastErrors();
                $warns  = is_array($errors) ? (int)($errors['warning_count'] ?? 0) : 0;
                $errs   = is_array($errors) ? (int)($errors['error_count'] ?? 0)  : 0;

                if ($warns === 0 && $errs === 0) {
                    $y = (int)$dt->format('Y');
                    if ($y >= 1900) {
                        return $dt->format('Y-m-d');
                    }
                }
            }
        }

        // 4) Last resort: strtotime
        $ts = strtotime($v);
        if ($ts !== false) {
            $y = (int)date('Y', $ts);
            if ($y >= 1900) {
                return date('Y-m-d', $ts);
            }
        }

        // Unparseable/invalid → null
        return null;
    }
}
