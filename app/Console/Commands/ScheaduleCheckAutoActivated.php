<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScheaduleCheckAutoActivated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'luxe:scheadule-check-auto-activated';

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
        //
        $this->info('Scheduled task is running...');
    }
}
