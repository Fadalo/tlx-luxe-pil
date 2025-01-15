<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Member\MemberPackageOrderSession;
use App\Models\Member\Member;
use App\Models\Member\MemberPackageOrder;
use App\Models\Package\PackageVariant;
use App\Models\Instructor\InstructorContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


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

    public function doBooking(Request $request,Response $response,$id){
      //  dd($id);
        if (!Auth::guard('member')->check()) {
            return redirect('/member/login');
        }
        //dd($value);

        $memberPackageOrder =  MemberPackageOrder::find($this->member_package_order_id);
        if ($memberPackageOrder){
          if ($MemberPackageOrder->qty_ticket_used <= $MemberPackageOrder->qty_ticket_available){
          
            $packageVariant = PackageVariant::find($MemberPackageOrder->package_variant_id);
            if($packageVariant){
              $memberPackageOrder->qty_ticket_used = $memberPackageOrder->qty_ticket_used + $packageVariant->package_qty_used_book;
              $memberPackageOrder->save();
  
  
              $MemberPackageOrderSession = new MemberPackageOrderSession;
              $MemberPackageOrderSession->member_package_order_id  = $this->member_package_order_id;
              $MemberPackageOrderSession->batch_session_id = $id;
              $MemberPackageOrderSession->status_session = 'book';
              $MemberPackageOrderSession->qty_ticket_used = $packageVariant->package_qty_used_book;
              
              $MemberPackageOrderSession->is_member_created = 1;
              $MemberPackageOrderSession->created_by = 1;
              $MemberPackageOrderSession->updated_by = 1;
              $MemberPackageOrderSession->save();
              return redirect('/member/detailBooking?id='.$this->member_package_order_id);
            }
           
          }
        }
       
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
        return view('livewire.component-member-booking', [
            'calendar' => $calendar,
            'selectedDate' => $this->selectedDate,
            'events' => $this->events,
        ]);
    }
   
}


