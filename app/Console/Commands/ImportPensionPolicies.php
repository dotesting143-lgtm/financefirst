<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PensionPolicy;
use League\Csv\Reader;

class ImportPensionPolicies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-pension-policies';

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
        $filePath = storage_path('app/pension_s4.csv');

        if (!file_exists($filePath)) {
            $this->error("File not found at: {$filePath}");
            return 1;
        }

        $this->info("Starting import from: {$filePath}");

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        $batchSize = 500;
        $batch = [];
        $total = iterator_count($records);
        $processed = 0;

        foreach ($records as $record) {
            $batch[] = [
                'id' => $record['id'],
                'client_id' => $record['client_id'] ?? null,
                'type' => $record['type'] ?? null,
                'start_date' => $this->validateDate($record['start_date']),
                'end_date' => $this->validateDate($record['end_date']),
                'term' => $record['term'] ?? null,
                //'propinsurer' => $record['propinsurer'] ?? null,
                //'propinsurer_num' => $record['propinsurer_num'] ?? null,
                'aptype' => $record['aptype'] ?? null,
                'sptype' => $record['sptype'] ?? null,
                'intname' => $record['intname'] ?? null,
                'intnum' => $record['intnum'] ?? null,
                'regcon' => $record['regcon'] ?? null,
                'sincon' => $record['sincon'] ?? null,
                'retage' => $record['retage'] ?? null,
                //'monthprem' => $record['monthprem'] ?? null,
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
            PensionPolicy::insert($batch);
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
