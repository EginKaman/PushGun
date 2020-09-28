<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScriptArchive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create archive with files for sites.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = storage_path('/app/public/pg-push.zip');
        $zip = new \ZipArchive();
        $zip->open($file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $zip->addFromString('pg-push-worker.js', view('scripts.worker'));
        $zip->close();
        $this->info('Script is created: ' . url('storage/pg-push.zip'));
        return 0;
    }
}
