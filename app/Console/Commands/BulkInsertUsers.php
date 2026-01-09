<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use League\Csv\Reader;

class BulkInsertUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:bulk-insert-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert multiple users into the database from a CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Path to the CSV file
        $filePath = storage_path('app/users.csv');

        if (!file_exists($filePath)) {
            $this->error("CSV file not found at $filePath");
            return;
        }

        // Open and read the CSV file
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // The first row contains headers

        // Prepare the users array
        $users = [];
        foreach ($csv as $row) {
            $users[] = [
                'name' => $row['name'],
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'role' => (int)$row['role'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert into the database
        User::insert($users);

        $this->info('Users have been inserted successfully!');
    }
}
