<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member\Member;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderSession;

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
        $oMPO = new MemberPackageOrder;
        $MemberPackageOrder =  $oMPO->where('status_package','activated')->get();
        if($MemberPackageOrder){
            foreach($MemberPackageOrder as $key=>$value){
                $MemberPackageOrderSession = MemberPackageOrderSession::join('batch_session','batch_session.id','=','member_package_order_session.batch_session_id')
                ->join('batch','batch.id','=','batch_session.batch_id')
                ->where('member_package_order_session.member_package_order_id',$value['id'])
                ->get();
            }
        }
        //$this->info('Scheduled task is running...');
        
    }
}
