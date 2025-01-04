<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member\Member;
use App\Models\Member\MemberPackageOrder;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorContract;
use App\Models\Instructor\InstructorInsentif;







class ScheaduleCheckCloseSession extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'luxe:scheadule-check-close-session';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'LUXE CLOSE SESSION';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       
        $oBS = new BatchSession;
        $listBS = $oBS->where('is_absen','=','1')
        ->where('end_datetime','=',date('Y-m-d H:i:00'))
        ->get();
        if($listBS){
            
            foreach($listBS as $key => $value){
                $oBS2 =  BatchSession::find($value->id);
                $oBS2->status_session = 'done';
                $oBS2->save();
                 
            }
        }
       // $p = print_r($listBS->toArray());
       // $p = print_r(date('Y-m-d H:i:00'));
        $p = 'Schedule:CheckCloseSession Running';
        $this->info($p);
    }
    
}
