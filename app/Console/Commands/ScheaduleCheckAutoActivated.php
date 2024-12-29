<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member\Member;
use App\Models\Member\MemberPackageOrder;



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
    protected $description = 'LUXE AUTO ACTIVATED PACKAGE SCHEDULE';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       
        
        // AutoActivate Scr
        $MemberPackageOrder = MemberPackageOrder::where('status_package','available')
        ->where('available_package_due_date','>',0)->get()->toArray();
        foreach($MemberPackageOrder as $key=> $value){
            $MemberPackageOrderP = MemberPackageOrder::find($value['id']);
            if ($MemberPackageOrderP->available_package_due_date == 1){
                $MemberPackageOrderP->status_package = 'activated';
                $MemberPackageOrderP->activated_package_started_datetime = now();
                $MemberPackageOrderP->activated_package_due_date =  (45*$MemberPackageOrderP->qty_ticket_available);
                $MemberPackageOrderP->available_package_due_date = 0;
                $MemberPackageOrderP->updated_at = now();
            }
            else{
                $MemberPackageOrderP->available_package_due_date = $MemberPackageOrderP->available_package_due_date - 1;
                $MemberPackageOrderP->updated_at = now();
            }
            $MemberPackageOrderP->save();
        }
     

        $this->info('Scheduled task is running...');
        
    }
}
