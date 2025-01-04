<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member\Member;
use App\Models\Package\Package;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderSession;

use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorContract;
use App\Models\Instructor\InstructorInsentif;







class ScheaduleCheckInstructorInsentif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'luxe:scheadule-check-instructor-insentif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'LUXE INSTRUCTOR INSENTIF';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       
        $oBS = new BatchSession;
        $iCountMemberBatch = '';
        $listBS = $oBS->where('is_absen','=','1')
        ->where('end_datetime','=',date('Y-m-d H:i:00'))
        ->get();
        if($listBS){
            
            foreach($listBS as $kk =>$vv){
               
                $InstructorContract = InstructorContract::where('instructor_id','=',$vv->instructor_id)
                //->where('package_id','=',$oBS->package_id)
                ->get();
                
                if($InstructorContract){
                    foreach( $InstructorContract as $kic => $vic){
                        $InsentifRule = json_decode($vic->insentif_rule,true);
                       
                        if(!empty($InsentifRule)){
                           
                            foreach($InsentifRule as $ki => $vi){
                               
                                switch($ki)
                                {
                                    case 'single':
                                        
                                                $insentif = $vi['amount'];
                                               
                                                if($insentif >= 0){
                                                    $Package = Package::find($vv->package_id);
                                                    $InstructorInsentif = new InstructorInsentif;
                                                    $InstructorInsentif->instructor_id = $vv->instructor_id;
                                                    $InstructorInsentif->session_id = $vv->id;
                                                    $InstructorInsentif->name = "Commision ". $Package ->name."-".$vv->name."(".date('l d-M-Y [H:i A',strtotime($vv->start_datetime)).date('-H:i A]',strtotime($vv->start_datetime)).")"." generated at ".date('d-m-y H:i:s');
                                                    $InstructorInsentif->amount = $insentif ;
                                                    $InstructorInsentif->created_by = 1;
                                                    $InstructorInsentif->updated_by = 1;
                                                    $InstructorInsentif->save();
                                                }
                                            break;
                                    case 'multi':
                                        
                                                foreach($vi as $kim => $vim){
                                                    
                                                    $iCountMemberBatch = $this->doCountMemberBatch($vv->id);
                                                    $insentif = 0;
                                                    if(($vim['start_qty'] <= $iCountMemberBatch) and ( $iCountMemberBatch <= $vim['end_qty'])){
                                                        $insentif = $vim['amount'];
                                                        if($insentif >= 0){
                                                            $InstructorInsentif = new InstructorInsentif;
                                                            $InstructorInsentif->instructor_id = $vv->instructor_id;
                                                            $InstructorInsentif->session_id = $vv->id;
                                                            $InstructorInsentif->name = "Commision ". $Package ->name."-".$vv->name."(".date('l d-M-Y [H:i A',strtotime($vv->start_datetime)).date('-H:i A]',strtotime($vv->start_datetime)).")"." generated at ".date('d-m-y H:i:s');
                                                            $InstructorInsentif->amount = $insentif ;
                                                            $InstructorInsentif->created_by = 1;
                                                            $InstructorInsentif->updated_by = 1;
                                                            $InstructorInsentif->save();
                                                        }
                                                        
                                                    }
                                               
                                                }
                                            break;
                                }
    
                            }
                        }
                        //dd($InsentifRule);
                        //echo $InsentifRule->dump();
                        //dump('Running scheduled task.sss..');
                    }
                        
                }
            }
           
        }
        $p =   $iCountMemberBatch ;
        $this->info($p);
        //dump('Running scheduled task.sss..');
    }

    public function doCountMemberBatch($batch_session_id){
        $totalMember = MemberPackageOrderSession::join('member_package_order','member_package_order.id','=','member_package_order_session.member_package_order_id')
        ->where('member_package_order_session.batch_session_id',$batch_session_id)
        ->count();
        
        return $totalMember;

    }
    
}
/*
  
                    */