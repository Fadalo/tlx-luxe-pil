<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member\Member;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderSession;

use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Package\PackageVariant;





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
        $iCountSession = 0;
        if($MemberPackageOrder){
            foreach($MemberPackageOrder as $key=>$value){
              
                $iCountSession =  $this->getCountSession($value['id']);
                $iMaxTicket = $this->getQtyTicketPackage($value['package_variant_id']);
               // print_r($iMaxTicket);
                if($iCountSession < $iMaxTicket ){
                    $oMPO1 =  MemberPackageOrder::find($value['id']);
                    if($oMPO1){
                        $oMPO1->status_package = 'expired';
                        $oMPO1->save();
                    }
                   
                }
                
            }
        }
      
       // $this->info('Scheduled task is running...');
       $this->info(  $iCountSession );
    }
    public function getQtyTicketPackage($id){
        $PackageVariant = PackageVariant::find($id);
        return $PackageVariant->package_qty_ticket;
    }
    public function getCountSession($id){
        $MemberPackageOrderSession = MemberPackageOrderSession::where('member_package_order_session.member_package_order_id',$id)
        ->selectRaw('
            member_package_order_session.member_package_order_id as member_package_order_id,
            sum(member_package_order_session.qty_ticket_used) as sumQtyTicketUsed
        ')
        ->groupBy('member_package_order_session.member_package_order_id')
        ->first();
        
        return $MemberPackageOrderSession->sumQtyTicketUsed;
    }
}
