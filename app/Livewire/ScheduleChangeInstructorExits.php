<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorContract;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;


class ScheduleChangeInstructorExits extends Component
{
    public $listInstructor = [];
    public $selected_instructor = '';
    public $batch_session_id = '';
    
    public function mount(){
        $this->listInstructor = $this->doGetInstructor($b=null);
    }
    public function doSave(){
        $BatchSession = BatchSession::find($this->batch_session_id);
        $BatchSession->instructor_id = $this->selected_instructor;
        $p = $BatchSession->save();
        $this->dispatch('doUpdateList',['BatchSession'=>$p]);
        //dd($BatchSession);
    }
    public function doGetInstructor($batch_id){
        $BatchSession = BatchSession::find($this->batch_session_id);
        
        $Instructor = Instructor::join('instructor_contract','instructor_contract.instructor_id','=','instructor.id')
       // ->join('batch_session','batch_session.instructor_id','=','instructor.id')
        ->where('instructor_contract.package_id','=',$BatchSession->package_id)
       // ->whereNotIn('batch_session.id',$this->getAllBatchId())
     
        ->selectRaw('
            instructor.id as id,
            CONCAT(instructor.first_name," ",instructor.last_name) as instructor_name
        ')
        ->groupBy('id')
        ->groupBy('instructor_name')
        ->get()->toArray();
        return $Instructor;
    }
    public function getAllBatchId(){
        $BatchSession = BatchSession::select('id')->get()->toArray();
        //dd($BatchSession);
        if($BatchSession)
        {
            return $BatchSession;
        }
        else{
            return [];
        }
       
    }
    public function render()
    {
        return view('livewire.schedule-change-instructor-exits');
    }
}
