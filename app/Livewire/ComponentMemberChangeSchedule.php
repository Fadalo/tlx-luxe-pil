<?php

namespace App\Livewire;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Member\MemberPackageOrderSession;
use App\Models\Member\Member;
use App\Models\Member\MemberPackageOrder;
use App\Models\Instructor\InstructorContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComponentMemberChangeSchedule extends Component
{

    public $month;
    public $year;
    public $events = [];
    public $selectedDate = '';
    public $member_id = '';
    public $member_package_order_id = '';
    public $cc='';
    public $old_member_package_order_session_id ='';

    public function mount()
    {
        $this->month = date('m');
        $this->year = date('Y');
        $this->old_member_package_order_session_id = $_GET['id'];
        $this->member_package_order_id = $_GET['mposid'];
        $this->member_id = Auth::guard('member')->User()->id;
       // dd($this->member_package_order_id);
        $this->getEventsForDate(date('Y-m-d'));
    }

    public function doChange($nid){
      //  dd($id);
        if (!Auth::guard('member')->check()) {
            return redirect('/member/login');
        }
        //dd($value);
        $MemberPackageOrderSession =  MemberPackageOrderSession::find($this->old_member_package_order_session_id );
        $MemberPackageOrderSession->batch_session_id  = $nid;
      
        $MemberPackageOrderSession->save();
        return redirect('/member/detailBooking?id='.$this->member_package_order_id);
    }
    public function getEventsForDate($date)
    {
          $this->selectedDate = $date;
          $MemberPackageOrderSession = MemberPackageOrderSession::get();
          $pm = [];
          if($MemberPackageOrderSession){
            foreach($MemberPackageOrderSession as $k => $v){
                $v = $v->batch_session_id;
              //  dd($v);
                $pm[] = $v;
            }
          }
        //  
        //  dd($MemberPackageOrderSession);
          $BatchSession =  BatchSession::join('batch','batch.id','=','batch_session.batch_id')
          ->join('member_package_order','member_package_order.batch_id','=','batch.id')

          ->where('member_package_order.member_id',$this->member_id)
          ->where('member_package_order.id',$this->member_package_order_id)
          ->where('batch_session.status_session','running')
          ->whereNotIn('batch_session.id',$pm )
          ->whereRaw('DATE(`batch_session`.`start_datetime`) = DATE(\''.$date.'\')')


          ->selectRaw('
            batch_session.*,
            batch_session.id as batch_session_id,
            batch.name as batch_name,
            batch.start_datetime as batch_start_datetime,
            batch.end_datetime as batch_end_datetime
          ')
          ->orderBy('batch_start_datetime','asc')->get()->toArray();
        //  dd( $BatchSession );
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
        $MemberPackageOrderSession = MemberPackageOrderSession::get();
        $pm = [];
        if($MemberPackageOrderSession){
          foreach($MemberPackageOrderSession as $k => $v){
              $v = $v->batch_session_id;
            //  dd($v);
              $pm[] = $v;
          }
        }
        $iCount =  BatchSession::join('batch','batch.id','=','batch_session.batch_id')
        ->join('member_package_order','member_package_order.batch_id','=','batch.id')
        ->where('member_package_order.member_id',$this->member_id)
        ->where('member_package_order.id',$this->member_package_order_id)
        ->where('batch_session.status_session','running')
        ->whereNotIn('batch_session.id',$pm )
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
        return view('livewire.component-member-change-schedule', [
            'calendar' => $calendar,
            'selectedDate' => $this->selectedDate,
            'events' => $this->events,
        ]);
    }
   
}

