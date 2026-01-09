<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Client;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;

class ImportClients extends Command
{
    protected $signature = 'app:import-clients';
    protected $description = 'Import clients from a CSV file';

    public function handle()
    {
        $filePath = storage_path('app/clients_s4.csv');

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
        //$total = iterator_count($records);
        $processed = 0;
        $insertedTotal = 0;

        $seenIds = [];

        foreach ($records as $record) {
            $id = trim($record['id'] ?? '');

            // skip if no id or already seen in this run
            if ($id === '' || isset($seenIds[$id])) {
                continue;
            }
            $seenIds[$id] = true;
            // Map CSV fields to database columns
            if(empty($record['sec_smoked_in_last_12_months'])) {
            	$record['sec_smoked_in_last_12_months'] = null;
            }
            $batch[] = [
                'id' => $record['id'],
                'active' => $record['active'],
                'title' => $record['title'],
                'first_name' => $record['first_name'],
                'last_name' => $record['last_name'],
                'date_of_birth' => $this->validateDate($record['date_of_birth']),
                'gender' => $record['gender'],
                'relationship_status' => $record['relationship_status'],
                'address' => $record['address'],
                'address2' => $record['address2'],
                'postcode' => $record['postcode'],
                'county_of_birth' => $record['county_of_birth'],
                'eircode' => $record['eircode'],
                'previous_surname' => $record['previous_surname'],
                'home_no' => $record['home_no'],
                'work_no' => $record['work_no'],
                'mobile_no' => $record['mobile_no'],
                'email' => $record['email'],
                'dependents' => $this->validateNumeric($record['dependents']),
                'smoked_in_last_12_months' => $record['smoked_in_last_12_months'],
                'broker' => $record['broker'],
                'broker_email' => $record['broker_email'],
                'employment_status' => $record['employment_status'],
                'employment_type' => $record['employment_type'],
                'net_salary_pm' => $this->validateNumeric($record['net_salary_pm']),
                'gross_basic_salary_pm' => $this->validateNumeric($record['gross_basic_salary_pm']),
                'overtime_pa' => $this->validateNumeric($record['overtime_pa']),
                'overtime_freq' => $record['overtime_freq'],
                'bonus_pa' => $this->validateNumeric($record['bonus_pa']),
                'bonus_freq' => $record['bonus_freq'],
                'commission_pa' => $this->validateNumeric($record['commission_pa']),
                'commission_freq' => $record['commission_freq'],
                'gross_salary_total' => $this->validateNumeric($record['gross_salary_total']),
                'other_income_pa_non_rental' => $this->validateNumeric($record['other_income_pa_non_rental']),
                'other_income_pa_existing_rental' => $this->validateNumeric($record['other_income_pa_existing_rental']),
                'other_income_pa_anticipated_rental' => $this->validateNumeric($record['other_income_pa_anticipated_rental']),
                'other_income_pa_total_rental' => $this->validateNumeric($record['other_income_pa_total_rental']),
                'occupation' => $record['occupation'],
                'employer' => $record['employer'],
                'employer_address1' => $record['employer_address1'],
                'employer_address2' => $record['employer_address2'],
                'length_service_yr' => $record['length_service_yr'],
                'length_service_mo' => $record['length_service_mo'],
                'prev_occupation' => $record['prev_occupation'],
                'prev_employer' => $record['prev_employer'],
                'prev_employer_address1' => $record['prev_employer_address1'],
                'prev_employer_address2' => $record['prev_employer_address2'],
                'prev_length_service_yr' => $record['prev_length_service_yr'],
                'prev_length_service_mo' => $record['prev_length_service_mo'],
                'business_name' => $record['business_name'],
                'business_nature' => $record['business_nature'],
                'business_add1' => $record['business_add1'],
                'business_add2' => $record['business_add2'],
                'date_estd' => $this->validateDate($record['date_estd']),
                'business_role' => $record['business_role'],
                'shareholding_pc' => $record['shareholding_pc'],
                'net_profit_3yrs_avg' => $this->validateNumeric($record['net_profit_3yrs_avg']),
                'drawings_3yrs_avg' => $this->validateNumeric($record['drawings_3yrs_avg']),
                'sec_title' => $record['sec_title'],
                'sec_first_name' => $record['sec_first_name'],
                'sec_last_name' => $record['sec_last_name'],
                'sec_date_of_birth' => $this->validateDate($record['sec_date_of_birth']),
                'sec_gender' => $record['sec_gender'],
                'sec_relationship_status' => $record['sec_relationship_status'],
                'sec_address' => $record['sec_address'],
                'sec_address2' => $record['sec_address2'],
                'sec_postcode' => $record['sec_postcode'],
                'sec_country_of_birth' => $record['sec_country_of_birth'],
                'sec_eircode' => $record['sec_eircode'],
                'sec_previous_surname' => $record['sec_previous_surname'],
                'sec_home_no' => $record['sec_home_no'],
                'sec_work_no' => $record['sec_work_no'],
                'sec_mobile_no' => $record['sec_mobile_no'],
                'sec_email' => $record['sec_email'],
                'sec_dependents' => $record['sec_dependents'],
                'sec_smoked_in_last_12_months' => $this->yesNoToBool($record['sec_smoked_in_last_12_months']),
                'sec_employment_status' => $record['sec_employment_status'],
                'sec_employment_type' => $record['sec_employment_type'],
                'sec_net_salary_pm' => $this->validateNumeric($record['sec_net_salary_pm']),
                'sec_gross_basic_salary_pm' => $this->validateNumeric($record['sec_gross_basic_salary_pm']),
                'sec_overtime_pa' => $this->validateNumeric($record['sec_overtime_pa']),
                'sec_overtime_freq' => $record['sec_overtime_freq'],
                'sec_bonus_pa' => $this->validateNumeric($record['sec_bonus_pa']),
                'sec_bonus_freq' => $record['sec_bonus_freq'],
                'sec_commission_pa' => $this->validateNumeric($record['sec_commission_pa']),
                'sec_commission_freq' => $record['sec_commission_freq'],
                'sec_gross_salary_total' => $this->validateNumeric($record['sec_gross_salary_total']),
                'sec_other_income_pa_non_rental' => $this->validateNumeric($record['sec_other_income_pa_non_rental']),
                'sec_other_income_pa_existing_rental' => $this->validateNumeric($record['sec_other_income_pa_existing_rental']),
                'sec_other_income_pa_anticipated_rental' => $this->validateNumeric($record['sec_other_income_pa_anticipated_rental']),
                'sec_other_income_pa_total_rental' => $this->validateNumeric($record['sec_other_income_pa_total_rental']),
                'sec_occupation' => $record['sec_occupation'],
                'sec_employer' => $record['sec_employer'],
                'sec_employer_address1' => $record['sec_employer_address1'],
                'sec_employer_address2' => $record['sec_employer_address2'],
                'sec_length_service_yr' => $record['sec_length_service_yr'],
                'sec_length_service_mo' => $record['sec_length_service_mo'],
                'sec_prev_occupation' => $record['sec_prev_occupation'],
                'sec_prev_employer' => $record['sec_prev_employer'],
                'sec_prev_employer_address1' => $record['sec_prev_employer_address1'],
                'sec_prev_employer_address2' => $record['sec_prev_employer_address2'],
                'sec_prev_length_service_yr' => $record['sec_prev_length_service_yr'],
                'sec_prev_length_service_mo' => $record['sec_prev_length_service_mo'],
                'sec_business_name' => $record['sec_business_name'],
                'sec_business_nature' => $record['sec_business_nature'],
                'sec_business_add1' => $record['sec_business_add1'],
                'sec_business_add2' => $record['sec_business_add2'],
                'sec_date_estd' => $this->validateDate($record['sec_date_estd']),
                'sec_business_role' => $record['sec_business_role'],
                'sec_shareholding_pc' => $record['sec_shareholding_pc'],
                'sec_net_profit_3yrs_avg' => $this->validateNumeric($record['sec_net_profit_3yrs_avg']),
                'sec_drawings_3yrs_avg' => $this->validateNumeric($record['sec_drawings_3yrs_avg']),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $processed++;

            if (count($batch) === $batchSize) {
                $insertedTotal += $this->insertBatch($batch);
                $batch = [];
                $this->info("Processed rows: {$processed}, inserted so far: {$insertedTotal}");
            }
        }

        if (!empty($batch)) {
            $insertedTotal += $this->insertBatch($batch);
        }

        $this->info("Import complete. Processed: {$processed}, Inserted: {$insertedTotal}");
        return 0;
    }

    private function insertBatch(array $batch): int
    {
        try {
            // Remove rows that already exist in DB by id (reduces noise)
            $ids = array_column($batch, 'id');
            $existingIds = Client::whereIn('id', $ids)->pluck('id')->all();
            if (!empty($existingIds)) {
                $existingLookup = array_flip($existingIds);
                $batch = array_values(array_filter($batch, fn($row) => !isset($existingLookup[$row['id']])));
            }

            if (empty($batch)) {
                return 0;
            }

            // Skip any remaining PK conflicts silently
            return Client::insertOrIgnore($batch);
        } catch (\Throwable $e) {
            $this->error("Error inserting batch: " . $e->getMessage());
            Log::error($e->getMessage(), ['batch' => $batch]);
            return 0;
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

    private function yesNoToBool($value)
    {
        if (empty($value)) {
            return null; // allow nulls if blank
        }

        $v = strtolower(trim($value));
        if (in_array($v, ['yes', 'y', '1', 'true'])) {
            return 1;
        } elseif (in_array($v, ['no', 'n', '0', 'false'])) {
            return 0;
        }

        return null; // for unexpected text
    }


}
