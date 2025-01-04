<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderSession;
use App\Models\Member\Member;
use App\Models\Member\Instructor;
use App\Models\Instructor\InstructorContract;
use Illuminate\Support\Facades\Auth;


class ComponentMemberDetailBooking extends Component
{

   
    public $events = [];
    public $member_id = '';
    public $member_package_order_id = '';
    
    public $member_package_order__order_id = '';
    
    public function mount()
    {
        
        $this->member_id = Auth::guard('member')->User()->id;
        $MemberPackageOrder = MemberPackageOrder::find($this->member_package_order_id);
        if($MemberPackageOrder){
            $this->member_package_order__order_id = $MemberPackageOrder->order_id;
        }
      
        $this->getData();
        //$this->getEventsForDate(date('Y-m-d'));
    }
    public function doDelete($id){
       // dd($id);
        $MemberPackageOrderSession = MemberPackageOrderSession::find($id)->delete();
        $this->getData();
    }
    public function doChangeSchedule($id){
       //dd($id);
       return redirect('/member/changeSchedule?id='.$id.'&mposid='.$this->member_package_order_id);
    }
    public function getData()
    {
        $MemberPackageOrderSession = MemberPackageOrderSession::where('member_package_order_id',$this->member_package_order_id);
        $this->events = $MemberPackageOrderSession->get()->toArray();
    }
    public function getEventsForDate($date)
    {
          //dd($this->member_id);
          $this->selectedDate = $date;
          $MemberPackageOrderSession =  MemberPackageOrderSession::join('batch_session','batch_session.id','=','member_package_order_session.batch_session_id')
          ->join('batch','batch.id','=','batch_session.batch_id')
          ->join('member_package_order','member_package_order.id','=','member_package_order_session.member_package_order_id')
          ->join('instructor','batch_session.instructor_id','=','instructor.id')
          

          ->where('member_package_order.member_id',$this->member_id)
          ->where('member_package_order.id',$this->member_package_order_id)
          
          ->where('batch_session.status_session','running')
         
          //->whereRaw('DATE(`batch_session`.`start_datetime`) = DATE(\''.$date.'\')')


          ->selectRaw('
            batch_session.*,
            batch.name as batch_name,
            batch_session.start_datetime as batch_start_datetime,
            batch_session.end_datetime as batch_end_datetime
          ')
          ->get()->toArray();
          $this->events = $MemberPackageOrderSession;
         
    }
    public function render()
    {
        return view('livewire.component-member-detail-booking');
    }
}
