<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProductNotes;

class ImportCSVCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:pnfnamelname';

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
        $filePath = storage_path('app/productnotes-names.csv');

        if (!file_exists($filePath)) {
            $this->error('CSV file not found!');
            return;
        }

        // Open CSV file
        $file = fopen($filePath, 'r');

        // Skip the first row (CSV header)
        fgetcsv($file);

        // Loop through CSV data
        while (($row = fgetcsv($file)) !== false) {
            $id = $row[0]; // ID column
            $firstname = $row[1]; // Firstname column
            $lastname = $row[2]; // Lastname column

            // Insert or update user by id
            ProductNotes::updateOrInsert(
                ['id' => $id], // Condition (ID is primary key)
                [
                    'first_name' => $firstname,
                    'last_name' => $lastname
                ]
            );
        }

        fclose($file);

        $this->info('CSV Data Imported Successfully!');
    }
}
