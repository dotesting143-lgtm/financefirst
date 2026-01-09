<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HousePolicy;
use League\Csv\Reader;

class ImportHousePolicy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-house-policy';

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
        $filePath = storage_path('app/house-policy.csv');

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
                'start_date' => $this->validateDate($record['start_date']) ?? null,
                'renewal_date' => $this->validateDate($record['renewal_date']) ?? null,
                'end_date' => $this->validateDate($record['end_date']) ?? null,
                'term' => $record['term'] ?? null,
                'curinsurer' => $record['curinsurer'] ?? null,
                'buildtype' => $record['buildtype'] ?? null,
                'buildcost' => $record['buildcost'] ?? null,
                'contcost' => $record['contcost'] ?? null,
                'propinsurer' => $record['propinsurer'] ?? null,
                'propinsurer_num' => $record['propinsurer_num'] ?? null,
                'smokealarm1' => $record['smokealarm1'] ?? null,
                'approved1' => $record['approved1'] ?? null,
                'locktypes' => $record['locktypes'] ?? null,
                'conyear' => $record['conyear'] ?? null,
                'contype' => $record['contype'] ?? null,
                'flatroof' => $record['flatroof'] ?? null,
                'noclaims' => $record['noclaims'] ?? null,
                'claimdetails' => $record['claimdetails'] ?? null,
                'housetype1' => $record['housetype1'] ?? null,
                'tenants' => $record['tenants'] ?? null,
                'lettype' => $record['lettype'] ?? null,
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
            HousePolicy::insert($batch);
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
