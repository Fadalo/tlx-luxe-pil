<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorContract;
use App\Models\Batch\BatchSession;
use Illuminate\Support\Facades\Auth;

class ScheduleChangeInstructorNew extends Component
{
    public $batch_session_id = '';
    public $form = [
        'first_name' => '',
        'last_name' => '',
        'phone_no' => '',
        'birthday' => ''

    ];
    public function doSave(){

        try{
            $BatchSession = BatchSession::find($this->batch_session_id);
            if($this->form['first_name'] !== '' && $this->form['last_name'] and $this->form['phone_no'] != '' && $this->form['birthday'] != '')
            {
                if ($BatchSession){
                    $Instructor = new Instructor();
                    $Instructor->first_name = $this->form['first_name'];
                    $Instructor->last_name  = $this->form['last_name'];
                    $Instructor->phone_no   = $this->form['phone_no'];
                    $Instructor->birthday   = $this->form['birthday'];
        
                    $Instructor->type = 'temporary';
                    $Instructor->is_verify = 1;
                    $Instructor->is_notify = 1;
                    $Instructor->status_document = 'draft';
                    $Instructor->status = 'draft';
                    $Instructor->join_date = now();
                    $Instructor->status_instructor = 1;
                    $Instructor->pin = '1234';
                    $Instructor->created_by = Auth::user()->id;
                    $Instructor->updated_by = Auth::user()->id;
                    
                    $Instructor->actived_date = now();
                    $Instructor->save();
                    if ($Instructor){
                        $InstructorContract = new InstructorContract;
                        $InstructorContract->name = "Contract Change Instructor - ".date('F, l d-m-Y [H:i A -',strtotime($BatchSession->start_datetime)).date('H:i A ]',strtotime($BatchSession->end_datetime));
                        $InstructorContract->package_id = $BatchSession->package_id;
                        $InstructorContract->instructor_id  = $Instructor->id;
                        $InstructorContract->contract_start_date = $BatchSession->start_datetime;
                        $InstructorContract->contract_end_date = $BatchSession->end_datetime;
                        $nInstructorContract = $InstructorContract->save();
                        if($nInstructorContract){
                        $BatchSession->instructor_id =  $Instructor->id;
                        $BatchSession->save();
                        }
                    }
                }
            }
            $this->dispatch('doUpdateList',[]);
        }
        catch(Exception $e){
            dd($e);
        }
    
    }

    
    
    public function doClear(){
        $this->form = [
            'first_name' => '',
            'last_name' => '',
            'phone_no' => '',
            'birthday' => ''
    
        ];
    }
    public function render()
    {
        return view('livewire.schedule-change-instructor-new');
    }
}
