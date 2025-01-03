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
        $listBS = $oBS->where('is_absen','=','1')->get();
        if($listBS){
            
            $InstructorContract = InstructorContract::where('instructor_id','=',$oBS->instructor_id)
            ->where('package_id','=',$oBS->package_id)
            ->get();
            if($InstructorContract){
                    $InsentifRule = json_decode($InstructorContract->insentif_rule,true);
            }

        }

        
    }
    
}
