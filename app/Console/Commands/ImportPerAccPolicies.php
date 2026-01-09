<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PerAccPolicy;
use League\Csv\Reader;

class ImportPerAccPolicies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-per-acc-policies';

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
        $filePath = storage_path('app/peracc_s4.csv');

        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return;
        }

        try {
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0); // Assuming the first row is headers
            $records = $csv->getRecords();

            $batchSize = 500; // Adjust batch size
            $batch = [];
            $total = iterator_count($records);
            $processed = 0;
            
            foreach ($records as $record) {
                $batch[] = [
                    'id' => $record['id'],
                    'client_id' => $record['client_id'] ?? null,
                    'type' => $record['type'] ?? null,
                    'start_date' => $this->validateDate($record['start_date']) ?? null,
                    'renewal_date' => $this->validateDate($record['renewal_date']) ?? null,
                    'end_date' => $this->validateDate($record['end_date']) ?? null,
                    'coveramt' => $record['coveramt'] ?? null,
                    //'propinsurer' => $record['propinsurer'],
                    //'propinsurer_num' => $record['propinsurer_num'],
                    'curinsurer' => $record['curinsurer'] ?? null,
                    'bentype' => $record['bentype'] ?? null,
                    'covtype' => $record['covtype'] ?? null,
                    'startimm1' => $record['startimm1'] ?? null,
                    'pricepledge1' => $record['pricepledge1'] ?? null,
                    //'monthprem' => $record['monthprem'],
                    'payfreq' => $record['payfreq'] ?? null,
                    'upfrontpay1' => $record['upfrontpay1'] ?? null,
                    'fdate' => $this->validateDate($record['fdate']) ?? null,
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
        } catch (Exception $e) {
            Log::error("CSV import error: " . $e->getMessage());
            $this->error("Failed to import CSV. Check logs for details.");
        }
    }

    private function insertBatch(array $batch)
    {
        try {
            PerAccPolicy::insert($batch);
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
}
