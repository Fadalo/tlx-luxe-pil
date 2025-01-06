<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorContract;
use App\Models\Member\MemberPackageOrderSession;

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
    public $idtable = 'id=tblSession';

    public  $selectedCheckALL = false;
    public  $session_name_prefix = '';
    public  $session_name_pick = '';

    public  $showContent = [
        'showList' => true,
        'showAdd' => false,
        'showChangeInstructor' => false
    ] ;
    public $selectedType =[
        'exits' => 'true',
        'new' =>'false'
    ];
    public $listAvailableSC = [];
    protected $listeners = ['doUpdateList'];
    public function mount(){

        $this->doShowList();
        $this->listSession = $this->doGetData();
       // $this->listAvailableSC = $this->filterAvailableSC($this->doGetScheduleInstructor(),$this->listSession);
        //$this->listAvailableSC = $this->doGetScheduleInstructor();
       // dd($this->listAvailableSC);
       $this->dispatch('batchsession:datatable_session',['sss'=>'']);
    }

    public function filterAvailableSC($a,$b){
       $p = [];
       $r = [];
       
       foreach($a as $ka => $va)
       {
            if (count($b) > 0){
                foreach($b as $kb => $vb )
                {
                 //   $p[$ka] = $va;
                    
                    if (date('Y-m-d H:i',strtotime($va['start_datetime'])) == date('Y-m-d H:i',strtotime($vb['start_datetime']))) 
                    {
                       // print_r('find');
                       // print_r(date('Y-m-d H:i',strtotime($va['start_datetime'])));
                       // print_r(date('Y-m-d H:i',strtotime($vb['start_datetime'])));
                        
                        //break;
                        unset($a[$ka]);
                    }
                    
                }
                $p = $a;
            }
            else {
                $p = $a;
                return $p;
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
                $BatchSession->instructor_id = $Batch->instructor_id;
                
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
        $this->listAvailableSC = $this->filterAvailableSC($this->doGetScheduleInstructor(),$this->doGetDataAll());
        $this->doClearSession();
        $this->doShowList();
      
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

        $this->session_name_prefix = '';
        $this->selectedCheckALL = false;
        $this->list=[];
    }
    public function doGetScheduleInstructor($instructor_id=null)
    {
        
        $dataSC = [] ;
        $batch = Batch::find($this->batch_id);
        $InstructorContract = InstructorContract::where('instructor_id',(is_null($instructor_id)?$batch ->instructor_id:$instructor_id))->get();
       
        $idd = 0;
        foreach($InstructorContract as $key =>$value){
                $r = json_decode($value->schedule_instructor,true);
                
                if (!empty($r)){
                    $startDate = new DateTime($value['contract_start_date']);
                    $endDate   = new DateTime($value['contract_end_date']);
                
                    $diff = date_diff($startDate,$endDate);
                
                    $i = date('d',strtotime($startDate->format('Y-m-d')));
                
                    foreach($r as $kr => $weeks){
                        
                        foreach($weeks as $krd => $days)
                        {
                            //dd($days);
                            foreach($days as $kday => $times)
                            {
                                // print_r($times['time_ranges']);
                                $weekDay = ($times['name']);
                                //  $idd = 0
                              // dd($times);
                                foreach($times['time_ranges'] as $ktime => $time){

                                  
                                    //print_r($time);
                                    //print_r('<br>');
                                    // LOOP FOR EACH DAYS
                                    for($m = $i; $m < $diff->d; $m++){
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
                                    
                                      //  dd($weekDay_d );
                                        if ($weekDay == $weekDay_d){
                                            //print_r($d);
                                            //print_r('<br>');
                                            // dd($d);
                                        //   print_r($time);
                                            $starNew = $d.' '.$time['start'];
                                            $endNew = $d.' '.$time['end'];

                                            //print_r($starNew);
                                            // GEN NEW DATE FROM SCHEDULE
                                            $start_datetime = date('Y-m-d H:i',strtotime($starNew));
                                            $end_datetime = date('Y-m-d H:i',strtotime($endNew));
                                            
                                            $dataSC[$idd]=[
                                                'id'             => $idd,
                                                'contract'       => $value['name'],
                                                'start_datetime' => $start_datetime,
                                                'end_datetime'   => $end_datetime,
                                                
                                            ];
                                          ///  print_r($dataSC[$idd]);
                                          //  print_r('<br>');
                                            $idd++;
                                        }
                                    
                                    }
                                  //  $dataSC[] = $dataSC1;
                                }
                            
                            }
                        }
                    }

                }
                
        }
        $idd = 0;
         //print_r(count($dataSC));
        $sortedArray= $dataSC;
         uasort($sortedArray, function($a, $b) {
            return strtotime($a['start_datetime']) - strtotime($b['start_datetime']);
        });
       
        return $sortedArray;
    }
   
    public function doGetData(){
        $BatchSession = BatchSession::join('batch','batch.id','=','batch_session.batch_id')
        ->join('package','package.id','=','batch_session.package_id')
        ->selectRaw('
            batch.id as batch_id,
            batch_session.id as id,
            batch_session.instructor_id as instructor_id,
            batch_session.name as name,
            batch.name as batch_name,
            batch_session.start_datetime as start_datetime,
            batch_session.end_datetime as end_datetime
        ')
        ->where('batch_id',$this->batch_id)
        ->get()->toArray();
        return $BatchSession;
    }
    public function doGetDataAll(){
        $BatchSession = BatchSession::join('batch','batch.id','=','batch_session.batch_id')
        ->join('package','package.id','=','batch_session.package_id')
        ->selectRaw('
            batch.id as batch_id,
            batch_session.id as id,
            batch_session.instructor_id as instructor_id,
            batch_session.name as name,
            batch.name as batch_name,
            batch_session.start_datetime as start_datetime,
            batch_session.end_datetime as end_datetime
        ')
       
        ->get()->toArray();
        return $BatchSession;
    }
    
    public function doShowAddSession(){
        $this->listAvailableSC = $this->filterAvailableSC($this->doGetScheduleInstructor(),$this->doGetDataAll());
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
        $this->dispatch('batchsession:datatable_session',['sss'=>'']);
    }
    public function doShowChangeInstructor($id){
        //dd($id);
        $BatchSession = BatchSession::find($id);

        $this->session_name_pick = $BatchSession->name.' '.date('F, l d-m-Y H:i A -',strtotime($BatchSession->start_datetime)).date(' H:i A ]',strtotime($BatchSession->end_datetime));
        $this->batch_session_id = $id;
        $this->showContent = [
            'showList' => false,
            'showAdd' => false,
            'showChangeInstructor' => true
        ] ;
    }
    public function doUpdateList($p)
    {
        //dd($p);
        $this->listSession = $this->doGetData();
        $this->doShowList();
    }
    public function doDelete($id){
        try{
             
             $iCountMPOS = MemberPackageOrderSession::where('batch_session_id',$id)->get()->count();
             if ($iCountMPOS == 0){
                $BatchSession = BatchSession::find($id)->delete();
                $this->listSession = $this->doGetData();
                $this->triggerAlert('Berhasil di delete','Success !!','success');
             }
            else{
                $this->triggerAlert('This Session Already Lock !!!','Error !!','error'); 
            }
        }
        catch (Exception $e) {
            $this->triggerAlert('This Session Already Lock !!!','Error !!','error');
        }
    }
    public function triggerAlert($msg,$title='Success!',$icon='success')
    {
        // Emit event to frontend to trigger SweetAlert
        $this->dispatch('swal:alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $msg,
        ]);
    }
    public function doShowExists()
    {
       // dd('sss');
        $this->selectedType =[
            'exits' => true,
            'new' =>false
        ];
    }
    public function doShowNew(){
        //dd('pp');
        $this->selectedType =[
            'exits' => false,
            'new' =>true
        ];
    }
    public function render()
    {
        return view('livewire.batch-session-picker');
    }
}
