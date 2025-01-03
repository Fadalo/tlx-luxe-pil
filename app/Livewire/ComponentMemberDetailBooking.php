<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Instructor\InstructorContract;
use Illuminate\Support\Facades\Auth;

class ComponentMemberDetailBooking extends Component
{

    public $month;
    public $year;
    public $events = [];
    public $selectedDate = '';
    public $member_id = '';
    public $member_package_order_id = '';
    public $cc='';
    public function mount()
    {
        $this->month = date('m');
        $this->year = date('Y');
        $this->member_id = Auth::guard('member')->User()->id;
        $this->getEventsForDate(date('Y-m-d'));
    }

    
    public function getEventsForDate($date)
    {
          $this->selectedDate = $date;
          $BatchSession =  BatchSession::join('batch','batch.id','=','batch_session.batch_id')
          ->join('member_package_order','member_package_order.batch_id','=','batch.id')
          ->where('member_package_order.member_id',$this->member_id)
          ->where('batch_session.status_session','running')
          ->whereRaw('DATE(`batch_session`.`start_datetime`) = DATE(\''.$date.'\')')


          ->selectRaw('
            batch_session.*,
            batch.name as batch_name,
            batch_session.start_datetime as batch_start_datetime,
            batch_session.end_datetime as batch_end_datetime
          ')
          ->get()->toArray();
          $this->events = $BatchSession;
         
    }
    public function render()
    {
        return view('livewire.component-member-detail-booking');
    }
}
