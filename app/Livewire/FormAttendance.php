<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\Member;
use App\Models\Instructor\Instructor;
use App\Models\Member\MemberPackageOrder;


class FormAttendance extends Component
{
    public $type ='Instructor';
    public $phone_no = '';
    public $render_result = '';

    public function doSearch(){
       // dd($this->phone_no);
       if ($this->phone_no != ''){
            if ($this->type == 'Instructor'){
                $Instructor = Instructor::where('phone_no','like',"%{$this->phone_no}%")->first();

                $param = [
                    'Instructor' => $Instructor,
                    
                ];
                $this->render_result = view('PanelAdmin.Attendance.attandenceInstructor',$param)->render();
            }
            else if ($this->type == 'Member'){
                $Member = Member::where('phone_no','like',"%{$this->phone_no}%")->first();
                $MemberPackageOrder = MemberPackageOrder::where('member_id',$Member->id);
                $param = [
                    'Member' => $Member,
                    'MemberPackageOrder' => $MemberPackageOrder
                ];
                $this->render_result = view('PanelAdmin.Attendance.attandanceMember',$param)->render();
            }
       }
    }

    public function doCountTicket($o){
        dd($o);
    }
    public function doClear(){
        $this->phone_no = '';
        $this->type = '';
        $this->render_result = '';
    }
    public function render()
    {
        return view('livewire.form-attendance');
    }
}
