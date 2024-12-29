<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\Member;
use App\Models\Instructor\Instructor;
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
       
       if ($this->phone_no != ''){
            if ($this->type == 'Instructor'){
                $Instructor = Instructor::where('phone_no','like',"%".$phoneNO."%")->first();
                //dd($Instructor);
                if($Instructor){
                    $param = [
                        'Instructor' => $Instructor,
                        
                    ];
                    $this->render_result = view('PanelAdmin.Attendance.attandenceInstructor',$param)->render();
       
                }
             }
            else if ($this->type == 'Member'){
                $Member = Member::where('phone_no','like',"%".$phoneNO."%")->first();
                if ($Member){
                    $MemberPackageOrder = MemberPackageOrder::where('member_id',$Member->id)
                    ->where('status_package','activated');
                
                    $param = [
                        'Member' => $Member,
                        'MemberPackageOrder' => $MemberPackageOrder
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
        dd($o);
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
    public function doAbsenInstructor(){
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
