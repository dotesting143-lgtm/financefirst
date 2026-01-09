<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommercialPolicy;
use League\Csv\Reader;

class ImportCommercialPolicies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-commercial-policies';

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
        $filePath = storage_path('app/commercial.csv');

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
                'client_id' => $record['client_id'],
                'type' => $record['type'],
                'start_date' => $this->validateDate($record['start_date']),
                'renewal_date' => $this->validateDate($record['renewal_date']),
                'end_date' => $this->validateDate($record['end_date']),
                'term' => $record['term'],
                'busdesc' => $record['busdesc'],
                'curinsurer' => $record['curinsurer'],
                //'propinsurer' => $record['propinsurer'],
                //'propinsurer_num' => $record['propinsurer_num'],
                'targetprem' => $record['targetprem'],
                'locdesc' => $record['locdesc'],
                'conwalls' => $record['conwalls'],
                'confloor' => $record['confloor'],
                'conroof' => $record['conroof'],
                'constory' => $record['constory'],
                'conheattype' => $record['conheattype'],
                'extblank' => $record['extblank'],
                'secalarm' => $record['secalarm'],
                'seccctv' => $record['seccctv'],
                'secwin' => $record['secwin'],
                'secdoor' => $record['secdoor'],
                'dambuild' => $record['dambuild'],
                'damfix' => $record['damfix'],
                'damstock' => $record['damstock'],
                'damplant' => $record['damplant'],
                'damgross' => $record['damgross'],
                'damworkings' => $record['damworkings'],
                'damrent' => $record['damrent'],
                'damempliab' => $record['damempliab'],
                'damclwage' => $record['damclwage'],
                'damoswage' => $record['damoswage'],
                'damppl' => $record['damppl'],
                'damturnover' => $record['damturnover'],
                'damcomputer' => $record['damcomputer'],
                'dammoney' => $record['dammoney'],
                'claimdate1' => $this->validateDate($record['claimdate1']),
                'claimdetails1' => $record['claimdetails1'],
                'claimamt1' => $record['claimamt1'],
                'claimreserv1' => $record['claimreserv1'],
                'claimdate2' => $this->validateDate($record['claimdate2']),
                'claimdetails2' => $record['claimdetails2'],
                'claimamt2' => $record['claimamt2'],
                'claimreserv2' => $record['claimreserv2'],
                'claimdate3' => $this->validateDate($record['claimdate3']),
                'claimdetails3' => $record['claimdetails3'],
                'claimamt3' => $record['claimamt3'],
                'claimreserv3' => $record['claimreserv3'],
                'claimdate4' => $this->validateDate($record['claimdate4']),
                'claimdetails4' => $record['claimdetails4'],
                'claimamt4' => $record['claimamt4'],
                'claimreserv4' => $record['claimreserv4'],
                'claimdate5' => $this->validateDate($record['claimdate5']),
                'claimdetails5' => $record['claimdetails5'],
                'claimamt5' => $record['claimamt5'],
                'claimreserv5' => $record['claimreserv5'],
                'pricepledge1' => $record['pricepledge1'],
                //'po_monthprem' => $record['po_monthprem'],
                'payfreq' => $record['payfreq'],
                'upfrontpay1' => $record['upfrontpay1'],
                'numpay' => $record['numpay'],
                'needs_obj_text' => $record['needs_obj_text'],
                'per_circ_text' => $record['per_circ_text'],
                'fin_sit_text' => $record['fin_sit_text'],
                'risk_profile_text' => $record['risk_profile_text'],
                'recommend_text' => $record['recommend_text'],
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
            CommercialPolicy::insert($batch);
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
