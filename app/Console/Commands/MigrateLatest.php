<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateLatest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:latest {--database=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the latest migration file automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $latestFile = collect(glob(database_path('migrations/*.php')))
            ->sortDesc()
            ->first();

        if ($latestFile) {
            $this->info("Running latest migration: " . basename($latestFile));
            Artisan::call('migrate', [
                '--path' => str_replace(base_path(), '', $latestFile),
                '--database' => $this->option('database')
            ]);
            $this->info(Artisan::output());
        } else {
            $this->warn("No migration files found.");
        }
    }
}
