<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorContract;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Auth;
use DateTime;

class BatchSessionPicker extends Component
{
    public  $batch_id = '';
    public  $instructor_id = '';
    public  $batch_session_id = '';
    public  $listSession = [];
    public  $list = [];

    public  $selectedCheckALL = false;
    public  $session_name_prefix = '';

    public  $showContent = [
        'showList' => true,
        'showAdd' => false,
        'showChangeInstructor' => false
    ] ;
    public $listAvailableSC = [];
    public function mount(){
        $this->doShowList();
        $this->listSession = $this->doGetData();
        $this->listAvailableSC = $this->filterAvailableSC($this->doGetScheduleInstructor(),$this->listSession);
       // dd($this->listAvailableSC);
    }

    public function filterAvailableSC($a,$b){
       $p = [];
       foreach($a as $ka => $va)
       {
          foreach($b as $kb => $vb ){
            //dd($va['start_datetime']);
             if($va['start_datetime'] == $vb['start_datetime'] && $va['end_datetime'] == $vb['end_datetime']  ){
                continue;
                //dd($va);
             }else{
                $p[$ka] = $va;
             }
             // if($ka == $kb && $va == $vb ){
             //dd($va);
             
             //}
          }
       }
       return $p;
    }
    public function doCheckAll(){
       
        if ( $this->selectedCheckALL == true)
        {
            foreach($this->listAvailableSC as $key => $val)
            {
                $this->list[$key]['value'] = true;
            }
        }
        else{
            foreach($this->listAvailableSC as $key => $val)
            {
                $this->list[$key]['value'] = false;
            }
        }
       // dd($this->list);
    }
    public function doSaveSession(){
        //dd($this->list);
        //dd($this->listAvailableSC);

        $Batch = Batch::find($this->batch_id);
        if($Batch){
            $i = 1;
            foreach($this->list as $key => $val){
                $o = $this->getAVSById($key);
               // dd($o);
               foreach ($o as $ko =>$vo){
                //dd($vo);
                $BatchSession = new BatchSession();
                $BatchSession->batch_id = $this->batch_id;
                $BatchSession->package_id = $Batch->package_id;
                $BatchSession->name = $this->session_name_prefix.$i;
                $BatchSession->start_datetime = date('Y-m-d H:i',strtotime($vo['start_datetime']));
                $BatchSession->end_datetime = date('Y-m-d H:i',strtotime($vo['end_datetime']));
                $BatchSession->status = 'draft';
                $BatchSession->status_session = 'running';
                $BatchSession->created_by = Auth::User()->id;
                $BatchSession->updated_by = Auth::User()->id;
                
                
                $BatchSession->save();
                $i++;
               }
            }
        }
       
        $this->listSession = $this->doGetData();
    // dd($o);
    }
    public function getAVSById($id)
    {
       // dd($id);
        $a = Arr::where($this->listAvailableSC, function ( $value,  $key ) use  ($id) {
          // dd($value);
          if ($key == $id){
            return $value;
          }
            
        });
        return $a;
    }
    public function doClearSession(){

    }
    public function doGetScheduleInstructor()
    {
        $dataSC = [] ;
        $batch = Batch::find($this->batch_id);
        $InstructorContract = InstructorContract::where('instructor_id',$batch ->instructor_id)->get();
        $idd = 0;
        foreach($InstructorContract as $key =>$value){
                $r = json_decode($value->schedule_instructor,true);
                $startDate = new DateTime($value['contract_start_date']);
                $endDate   = new DateTime($value['contract_end_date']);
             
                $diff = date_diff($startDate,$endDate);
             
                $i = date('d',strtotime($startDate->format('Y-m-d')));
                for($m = $i; $m <= $diff->d; $m++){
                    foreach($r as $kr => $weeks){
                    
                        foreach($weeks as $krd => $days)
                        {
                           
                            foreach($days as $kday => $times)
                            {
                               // print_r($times['time_ranges']);
                                $weekDay = ($times['name']);
                                foreach($times['time_ranges'] as $ktime => $time){

                                   
                                  
                                    // GET DATE FROM CONTRACT
                                    $week = [
                                       
                                        'SAT' => 'ST',
                                        'MON' => 'MO',
                                        'TUE' => 'TU',
                                        'WED' => 'WE',
                                        'THU' => 'TH',
                                        'FRI' => 'FR',
                                        'SUN' => 'SU'

                                    ];
                                    $d = date('Y-m-'.$m,strtotime($startDate->format('Y-m-d')));
                                    $weekDay_d = $week[strtoupper(date('D',strtotime($d)))];
                                   
                                    if ($weekDay == $weekDay_d){
                                         // dd($d);
                                      //   print_r($time);
                                        $starNew = $d.' '.$time['start'];
                                        $endNew = $d.' '.$time['end'];

                                         //print_r($starNew);
                                        // GEN NEW DATE FROM SCHEDULE
                                        $start_datetime = date('d-m-Y H:i',strtotime($starNew));
                                        $end_datetime = date('d-m-Y H:i',strtotime($endNew));
                                        
                                        $dataSC[$idd]=[
                                            'id'             => $idd,
                                            'start_datetime' => $start_datetime,
                                            'end_datetime' => $end_datetime,
                                            
                                        ];
                                        $idd = $idd + 1;
                                    }
                                   
                                }
                            }
                        
                        }
                    }
                }
        }
     //   print_r($dataSC);
        return $dataSC;
    }
   
    public function doGetData(){
        $BatchSession = BatchSession::join('batch','batch.id','=','batch_session.batch_id')
        ->join('package','package.id','=','batch_session.package_id')
        ->selectRaw('
            batch.id as batch_id,
            batch_session.id as id,
            batch_session.name as name,
            batch.name as batch_name,
            batch_session.start_datetime as start_datetime,
            batch_session.end_datetime as end_datetime
        ')
        ->where('batch_id',$this->batch_id)
        ->get()->toArray();
        return $BatchSession;
    }
    public function doShowAddSession(){
        $this->showContent = [
            'showList' => false,
            'showAdd' => true,
            'showChangeInstructor' => false
        ] ;
    }
    public function doShowList(){

        
        $this->showContent = [
            'showList' => true,
            'showAdd' => false,
            'showChangeInstructor' => false
        ] ;
    }
    public function doShowChangeInstructor(){
        $this->showContent = [
            'showList' => false,
            'showAdd' => false,
            'showChangeInstructor' => true
        ] ;
    }
    public function doDelete($id){

    }
    public function render()
    {
        return view('livewire.batch-session-picker');
    }
}
