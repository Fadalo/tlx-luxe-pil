<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Instructor\InstructorContract;
use Illuminate\Support\Facades\Auth;

class ComponentMemberBooking extends Component
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
       // dd($this->member_package_order_id);
        $this->getEventsForDate(date('Y-m-d'));
    }

    
    public function getEventsForDate($date)
    {
          $this->selectedDate = $date;
          $BatchSession =  BatchSession::join('batch','batch.id','=','batch_session.batch_id')
          ->join('member_package_order','member_package_order.batch_id','=','batch.id')
          ->where('member_package_order.member_id',$this->member_id)
          ->where('member_package_order.id',$this->member_package_order_id)
          ->where('batch_session.status_session','running')
          ->whereRaw('DATE(`batch_session`.`start_datetime`) = DATE(\''.$date.'\')')


          ->selectRaw('
            batch_session.*,
            batch_session.id as batch_session_id,
            batch.name as batch_name,
            batch.start_datetime as batch_start_datetime,
            batch.end_datetime as batch_end_datetime
          ')
          ->orderBy('batch_start_datetime','asc')
          ->get()->toArray();
          $this->events = $BatchSession;
         
    }
    public function doNext(){
      //  dd($this->month);
        $this->month = $this->month + 1;
        if ($this->month == 13)
        {
            $this->month = 1;
            $this->year = $this->year + 1;
        }
    
        $this->render();
    }
    public function doPrev(){
        $this->month = $this->month - 1;
        if ($this->month == 0)
        {
            $this->month = 12;
            $this->year = $this->year - 1;
        }
        $this->render();
    }
    public function checkEvent($date){
        $iCount =  BatchSession::join('batch','batch.id','=','batch_session.batch_id')
        ->join('member_package_order','member_package_order.batch_id','=','batch.id')
        ->where('member_package_order.member_id',$this->member_id)
        ->where('member_package_order.id',$this->member_package_order_id)
        ->where('batch_session.status_session','running')
        ->whereRaw('DATE(`batch_session`.`start_datetime`) = DATE(\''.$date.'\')')
      
        ->get()->count();
        return ($iCount > 0)? true : false;
    }
    public function render()
    {
        $date =  Carbon::createFromDate($this->year, $this->month);
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SATURDAY);

       
        while($startOfCalendar <= $endOfCalendar)
        {
            $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'cal-disabled' : '';
            $extraClass .= $startOfCalendar->isToday() ? 'cal-selected' : '';
            $today = $startOfCalendar->isToday() ? true : false;
            $event = $this->checkEvent($startOfCalendar->format('Y-m-d')) ;
            

            $days[] = 
            [
                'day' => $startOfCalendar->format('j') ,
                'date' => $startOfCalendar->format('Y-m-d'),
                'extraClass' =>$extraClass,
                'today' => $today ,
                'event' => $event,
            ];
            $startOfCalendar->addDay();
        }
        $calendar[] = $days;
        return view('livewire.component-member-booking', [
            'calendar' => $calendar,
            'selectedDate' => $this->selectedDate,
            'events' => $this->events,
        ]);
    }
   
}


