<?php

namespace App\Console\Commands;

use App\Models\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class FixBrokerInClients extends Command
{
    protected $signature = 'app:fix-broker-in-clients
        {--chunk=500}
        {--dry-run}';

    protected $description = 'Fix broker and broker_email in clients from clients_s5.csv';

    public function handle(): int
    {
        $filePath = storage_path('app/clients_s5.csv');
        $chunk  = (int) $this->option('chunk');
        $dryRun = (bool) $this->option('dry-run');

        if (!file_exists($filePath)) {
            $this->error("CSV not found at: {$filePath}");
            return self::FAILURE;
        }

        $this->info("Reading CSV: {$filePath}");

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);

        $required = ['client_id', 'broker_email', 'broker_id'];
        foreach ($required as $col) {
            if (!in_array($col, $csv->getHeader(), true)) {
                $this->error("Missing required column: {$col}");
                return self::FAILURE;
            }
        }

        $records = iterator_to_array($csv->getRecords());
        $byClient = [];

        foreach ($records as $row) {
            $id = trim($row['client_id']);
            if ($id === '') continue;

            $byClient[$id] = [
                'broker_email' => trim($row['broker_email']),
                'broker'       => trim($row['broker_id']), // ✅ changed here
            ];
        }

        $total = count($byClient);
        $this->info("Total unique clients: {$total}");
        $this->info($dryRun ? 'DRY RUN' : 'Updating DB...');

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $updated = $skippedMissing = $skippedInvalidEmail = $skippedNoChange = 0;
        $batch = [];

        $flush = function () use (&$batch, &$updated, &$skippedNoChange, $dryRun) {
            if (!$batch) return;

            if ($dryRun) {
                foreach ($batch as $item) {
                    if ($item['client']->broker == $item['broker'] &&
                        $item['client']->broker_email == $item['broker_email']) {
                        $skippedNoChange++;
                    } else {
                        $updated++;
                    }
                }
            } else {
                DB::transaction(function () use (&$batch, &$updated, &$skippedNoChange) {
                    foreach ($batch as $item) {
                        $client = $item['client'];

                        if ($client->broker == $item['broker'] &&
                            $client->broker_email == $item['broker_email']) {
                            $skippedNoChange++;
                            continue;
                        }

                        $client->update([
                            'broker_email' => $item['broker_email'] ?: null,
                            'broker'       => $item['broker'] !== '' ? (int)$item['broker'] : null, // ✅ changed here
                        ]);

                        $updated++;
                    }
                });
            }

            $batch = [];
        };

        foreach ($byClient as $clientId => $row) {
            $client = Client::find($clientId);
            if (!$client) {
                $skippedMissing++;
                $bar->advance();
                continue;
            }

            $email = $row['broker_email'] ?: null;
            $broker = $row['broker'] !== '' ? (int)$row['broker'] : null;

            if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $skippedInvalidEmail++;
                $bar->advance();
                continue;
            }

            $batch[] = [
                'client'       => $client,
                'broker_email' => $email,
                'broker'       => $broker,
            ];

            if (count($batch) >= $chunk) $flush();
            $bar->advance();
        }

        $flush();
        $bar->finish();
        $this->newLine(2);

        $this->table(
            ['Metric', 'Count'],
            [
                ['Updated', $updated . ($dryRun ? ' (dry-run)' : '')],
                ['Skipped - No Change', $skippedNoChange],
                ['Skipped - Missing Client', $skippedMissing],
                ['Skipped - Invalid Email', $skippedInvalidEmail],
            ]
        );

        return self::SUCCESS;
    }
}
