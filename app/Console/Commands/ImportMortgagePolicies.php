<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MortgagePolicy;
use League\Csv\Reader;
use League\Csv\Exception;
use Illuminate\Support\Facades\Log;

class ImportMortgagePolicies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:mortgage-policies';

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
        $filePath = storage_path('app/mortgage_s3.csv');

        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return;
        }

        try {
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0); // Assuming the first row is headers
            $records = $csv->getRecords();
            
            foreach ($records as $record) {
                MortgagePolicy::insert([
                    'id' => $record['id'],
                    'client_id' => $record['client_id'] ?? null,
                    'type' => $record['type'] ?? null,
                    'start_date' => $this->validateDate($record['start_date']) ?? null,
                    'end_date' => $this->validateDate($record['end_date']) ?? null,
                    'term' => $record['term'] ?? null,
                    'monthprem' => $record['monthprem'] ?? null,
                    'coveramt' => $record['coveramt'] ?? null,
                    'propinsurer' => $record['propinsurer'] ?? null,
                    //'propinsurer_num' => $record['propinsurer_num'],
                    'propadd1' => $record['propadd1'] ?? null,
                    'propadd2' => $record['propadd2'] ?? null,
                    'proptype' => $record['proptype'] ?? null,
                    'proprooms' => $record['proprooms'] ?? null,
                    'propcontype1' => $record['propcontype1'] ?? null,
                    'propuse1' => $record['propuse1'] ?? null,
                    'propyear' => $record['propyear'] ?? null,
                    'propyearsrun' => $record['propyearsrun'] ?? null,
                    'propprice' => $record['propprice'] ?? null,
                    'propvalue' => $record['propvalue'] ?? null,
                    'guarname' => $record['guarname'] ?? null,
                    'guardob' => $this->validateDate($record['guardob']) ?? null,
                    'guaradd1' => $record['guaradd1'] ?? null,
                    'guaradd2' => $record['guaradd2'] ?? null,
                    'guarhomeno' => $record['guarhomeno'] ?? null,
                    'guarmobile' => $record['guarmobile'] ?? null,
                    'guaroccup' => $record['guaroccup'] ?? null,
                    'guarincome' => $record['guarincome'] ?? null,
                    'guarrelapp' => $record['guarrelapp'] ?? null,
                    'guaremail' => $record['guaremail'] ?? null,
                    'needs_obj_text' => $record['needs_obj_text'] ?? null,
                    'per_circ_text' => $record['per_circ_text'] ?? null,
                    'fin_sit_text' => $record['fin_sit_text'] ?? null,
                    'risk_profile_text' => $record['risk_profile_text'] ?? null,
                    'recommend_text' => $record['recommend_text'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->info("CSV file successfully imported!");
        } catch (Exception $e) {
            Log::error("CSV import error: " . $e->getMessage());
            $this->error("Failed to import CSV. Check logs for details.");
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
