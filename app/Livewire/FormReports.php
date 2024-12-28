<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\Member;
use App\Models\Instructor\Instructor;

class FormReports extends Component
{
   
    public $render_result = '';
    public $selectedReport = 'QtyTicketAvailableLeftMember';
    public $form = [
        'type' => '',
        'instructor_id' => '',
        'member_id' => '',
        'dStartDate' => '',
        'dEndDate' => '',
    ];
    public $viewControl = [
        'instructor_view' => false,
        'member_view' => false,
        'dStartDate_view' => true,
        'dEndDate_view' => true,
    ];
    public $ListMember = [];
    public $ListInstructor = [];
    public function mount(){
        
        $this->ListMember = Member::All()->toArray();
        $this->ListInstructor = Instructor::All()->toArray();
        
    }
    public function changeShowControl(){

       
        switch($this->selectedReport){
            case 'QtyTicketAvailableLeftMember':
                    $this->viewControl = [
                        'instructor_view' => false,
                        'member_view' => false,
                        'dStartDate_view' => true,
                        'dEndDate_view' => true,
                    ];
                    break;
            case 'MemberAttandence':
                    $this->viewControl = [
                        'instructor_view' => false,
                        'member_view' => true,
                        'dStartDate_view' => true,
                        'dEndDate_view' => true,
                    ];    
                   break;        
            case 'Insentif':
                    $this->viewControl = [
                        'instructor_view' => true,
                        'member_view' => false,
                        'dStartDate_view' => true,
                        'dEndDate_view' => true,
                    ];
               break;        
                     
            case 'TodaySchedule':
                    $this->viewControl = [
                        'instructor_view' => true,
                        'member_view' => false,
                        'dStartDate_view' => false,
                        'dEndDate_view' => false,
                    ];      
                    break;
            case 'Member':
                    $this->viewControl = [
                        'instructor_view' => false,
                        'member_view' => false,
                        'dStartDate_view' => true,
                        'dEndDate_view' => true,
                    ];
                    break;
            case 'Instructor':
                    $this->viewControl = [
                        'instructor_view' => false,
                        'member_view' => false,
                        'dStartDate_view' => true,
                        'dEndDate_view' => true,
                    ];         
                    break;
            case 'Package':
                    $this->viewControl = [
                        'instructor_view' => false,
                        'member_view' => false,
                        'dStartDate_view' => false,
                        'dEndDate_view' => false,
                    ];        
                    break;
              
          }

    }

    public function doSearch(){
       
           // $Member = Member::where('phone_no',$this->phone_no);
          // dd($this->form);
      //  dd($report);
      switch($this->selectedReport){
        case 'QtyTicketAvailableLeftMember':
                     $param['dStartDate']  = $this->form['dStartDate'];
                     $param['dEndDate']    = $this->form['dEndDate'];
                     $param['member_id']   =  $this->form['member_id'];
                     
                     $this->render_result = env('APP_URL').'/report/QtyTicketAvailableLeftMember';
                break;

        case 'MemberAttandence':
                    $param['member_id']   =  $this->form['member_id'];
                    $param['dStartDate']  = $this->form['dStartDate'];
                    $param['dEndDate']    = $this->form['dEndDate'];
                    $this->render_result = env('APP_URL').'/report/MemberAttandence';
               break;        

        case 'Insentif':
                    $param['instructor_id'] =  $this->form['instructor_id'];
                    $param['dStartDate']    = $this->form['dStartDate'];
                    $param['dEndDate']      = $this->form['dEndDate'];
                    $this->render_result = env('APP_URL').'/report/Insentif';
               break;        
        case 'TodaySchedule':
                    $param['instructor_id'] =  $this->form['instructor_id'];
                    $param['dStartDate']    = now();
                    $param['dEndDate'] =  now();
                    $this->render_result =  env('APP_URL').'/report/TodaySchedule';
                break;
        case 'Member':
                    $param['dStartDate']    = $this->form['dStartDate'];
                    $param['dEndDate'] = $this->form['dEndDate'];
                    $this->render_result =  env('APP_URL').'/report/Member';
                break;
        case 'Instructor':
                    $param['dStartDate']    = $this->form['dStartDate'];
                    $param['dEndDate'] = $this->form['dEndDate'];
                     $this->render_result =  env('APP_URL').'/report/Instructor';
                break;
        case 'Package':
                    
                    $this->render_result =  env('APP_URL').'/report/Package';
                break;
          
      }
    }
    public function render()
    {
        return view('livewire.form-reports');
    }
}
