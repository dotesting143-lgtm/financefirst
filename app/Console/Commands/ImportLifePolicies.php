<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LifePolicy;
use League\Csv\Reader;

class ImportLifePolicies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-life-policies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import life policies from a CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = storage_path('app/lifepolicies_s5.csv');

        if (!file_exists($filePath)) {
            $this->error("File not found at: {$filePath}");
            return 1;
        }

        $this->info("Starting import from: {$filePath}");

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // Assumes the first row contains headers
        $records = $csv->getRecords();

        $batchSize = 500; // Adjust batch size
        $batch = [];
        $total = iterator_count($records);
        $processed = 0;

        foreach ($records as $record) {
            // Map CSV fields to database columns
            $batch[] = [
                'id' => $record['id'],
                'client_id' => $record['client_id'] ?? null,
                'type' => $record['type'] ?? null,
                'start_date' => $this->normalizeDate($record['start_date'], 'Y-m-d'),
                'renewal_date' => $this->normalizeDate($record['renewal_date'], 'Y-m-d'),
                'end_date' => $this->normalizeDate($record['end_date'], 'Y-m-d'),
                'term' => $record['term'] ?? null,
                'curinsurer' => $record['curinsurer'] ?? null,
                'propinsurer' => $record['propinsurer'] ?? null,
                'coveramt_1' => $record['coveramt_1'] ?? null,
                'coveramt_2' => $record['coveramt_2'] ?? null,
                'specill_1' => $record['specill_1'] ?? null,
                'specill_2' => $record['specill_2'] ?? null,
                'specill_type_11' => $record['specill_type_11'] ?? null,
                'specill_type_21' => $record['specill_type_21'] ?? null,
                'hoscash_1' => $record['hoscash_1'] ?? null,
                'hoscash_2' => $record['hoscash_2'] ?? null,
                'occclass1_11' => $record['occclass1_11'] ?? null,
                'occclass1_21' => $record['occclass1_21'] ?? null,
                'acccover_1' => $record['acccover_1'] ?? null,
                'acccover_2' => $record['acccover_2'] ?? null,
                'occclass2_11' => $record['occclass2_11'] ?? null,
                'occclass2_21' => $record['occclass2_21'] ?? null,
                'height_ft_1' => $record['height_ft_1'] ?? null,
                'height_ft_2' => $record['height_ft_2'] ?? null,
                'height_in_1' => $record['height_in_1'] ?? null,
                'height_in_2' => $record['height_in_2'] ?? null,
                'height_me_1' => $record['height_me_1'] ?? null,
                'height_me_2' => $record['height_me_2'] ?? null,
                'height_cm_1' => $record['height_cm_1'] ?? null,
                'height_cm_2' => $record['height_cm_2'] ?? null,
                'weight_st_1' => $record['weight_st_1'] ?? null,
                'weight_st_2' => $record['weight_st_2'] ?? null,
                'weight_lb_1' => $record['weight_lb_1'] ?? null,
                'weight_lb_2' => $record['weight_lb_2'] ?? null,
                'weight_kg_1' => $record['weight_kg_1'] ?? null,
                'weight_kg_2' => $record['weight_kg_2'] ?? null,
                'guarantee1' => $record['guarantee1'] ?? null,
                'infprotect1' => $record['infprotect1'] ?? null,
                'startimm1' => $record['startimm1'] ?? null,
                'pricepledge1' => $record['pricepledge1'] ?? null,
                'monthprem' => $record['monthprem'] ?? null,
                'payfreq' => $record['payfreq'] ?? null,
                'upfrontpay1' => $record['upfrontpay1'] ?? null,
                'numpay' => $record['numpay'] ?? null,
                'needs_obj_text' => $record['needs_obj_text'] ?? null,
                'per_circ_text' => $record['per_circ_text'] ?? null,
                'fin_sit_text' => $record['fin_sit_text'] ?? null,
                'risk_profile_text' => $record['risk_profile_text'] ?? null,
                'recommend_text' => $record['recommend_text'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
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
            LifePolicy::insert($batch);
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
