<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member\Member;
use App\Models\Member\MemberPackageOrder;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;





class ScheaduleCheckAutoBurnTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'luxe:scheadule-check-auto-burn-ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'LUXE BURN TICKET SCHEDULE';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        //$i = 0;
        //$member= Member::find(1);
        //$member->count = $member->count + 1;
        //$member->save();
        //$this->info('Scheduled task is running...');
        
    }
}
