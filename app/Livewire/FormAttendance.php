<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\Member;
use App\Models\Instructor\Instructor;
use App\Models\Batch\BatchSession;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderSession;

use Illuminate\Support\Facades\Auth;

use  App\Helpers\H1BHelper;

class FormAttendance extends Component
{
    public $type ='Instructor';
    public $phone_no = '';
    public $render_result = '';

    public function doSearch(){
     //  dd($this->phone_no);
       $phoneNO = H1BHelper::clearPhoneNo($this->phone_no);
       $timeMinus30 = date('Y-m-d H:i:s', strtotime('-30 minutes'));
       if ($this->phone_no != ''){
            if ($this->type == 'Instructor'){
                $Instructor = Instructor::where('phone_no','like',"%".$phoneNO."%")->first();
                //dd($Instructor);
                if($Instructor){
                   // dd($timeMinus30);
                    $BatchSession = BatchSession::where('instructor_id','=',$Instructor->id)
                    ->where('start_datetime','>',$timeMinus30)
                    ->where('is_absen','=',0);
                    $param = [
                        'Instructor' => $Instructor,
                        'BatchSession' =>$BatchSession
                        
                    ];
                    $this->render_result = view('PanelAdmin.Attendance.attandenceInstructor',$param)->render();
       
                }
             }
            else if ($this->type == 'Member'){
                $Member = Member::where('phone_no','like',"%".$phoneNO."%")->first();
               
                if ($Member){
                  
                    $MemberPackageOrderSession = MemberPackageOrderSession::join('batch_session','batch_session.id','=','member_package_order_session.batch_session_id')
                    ->join('member_package_order','member_package_order.id','=','member_package_order_session.member_package_order_id')
                    ->join('batch','batch.id','=','batch_session.batch_id')
                    ->join('package','package.id','=','batch_session.package_id')
                    ->join('package_variant','package_variant.package_id','=','package.id')

                    ->where('batch_session.start_datetime','>',$timeMinus30)
                    ->where('member_package_order.status_package','activated')
                    ->where('member_package_order.id','=',$Member->id)
                    ->where('member_package_order_session.is_absen','=',0)
                    ->orderBy('start_datetime','asc')
                    ->selectRaw('
                        member_package_order.id as member_package_order_id,
                        member_package_order.order_id as order_id,
                        member_package_order_session.id as member_package_order_session_id,
                        member_package_order_session.qty_ticket_used as qty_ticket_used,
                        member_package_order_session.is_absen as is_absen,
                        batch.name as batch_name,
                        batch_session.name as batch_session_name,
                        package.name as package_name,
                        package_variant.name as package_variant_name,
                        
                        
                        
                        batch_session.start_datetime as start_datetime,
                        batch_session.end_datetime as end_datetime

                        
                        
                    ');
                   // dd($MemberPackageOrderSession->toSql());
                    $param = [
                        'Member' => $Member,
                        'MemberPackageOrderSession' => $MemberPackageOrderSession
                    ];
                    $this->render_result = view('PanelAdmin.Attendance.attandenceMember',$param)->render();
                }
               
            }
       }
    }
    public function updateList(){
        $this->doSearch();
    }
    public function doCountTicket($o){
        //dd($o);
    }
    public function doClear(){
        $this->phone_no = '';
        $this->type = '';
        $this->render_result = '';
    }
    public function doAbsenMember($member_package_order_session_id){
        if (!Auth::check()) {
            return redirect('/login-new');
        }
       // dd($member_package_order_session_id);
        $MemberPackageOrderSession = MemberPackageOrderSession::find($member_package_order_session_id);
        $MemberPackageOrderSession->status_session = 'used';
        $MemberPackageOrderSession->is_absen = '1';
        $MemberPackageOrderSession->datetime_absen = now();
        $MemberPackageOrderSession->updated_by = Auth::User()->id;
        $MemberPackageOrderSession->updated_at = now();
        $MemberPackageOrderSession->save();
        $this->triggerAlert('Berhasil Absen !!',$title='Success!',$icon='success');
   
        $this->doClear();
    }
    public function doAbsenInstructor($batch_session_id){
        if (!Auth::check()) {
            return redirect('/login-new');
        }

        $BatchSession = BatchSession::find($batch_session_id);
        $BatchSession->is_absen = 1;
        $BatchSession->datetime_absen = now();
        $BatchSession->updated_by = Auth::User()->id;
        $BatchSession->updated_at = now();
        $BatchSession->save();

        $this->triggerAlert('Berhasil Absen !!',$title='Success!',$icon='success');
        $this->doClear();
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
    public function render()
    {
        return view('livewire.form-attendance');
    }
}
