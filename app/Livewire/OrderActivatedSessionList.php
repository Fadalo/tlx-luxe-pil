<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrderSession;

class OrderActivatedSessionList extends Component
{
    public $config = [];
    public $member_package_order_id = '';
    public $list_session = [];
    public function mount(){
        //dd($this->member_package_order_id);
        $MemberPackageOrderSession = MemberPackageOrderSession::where('member_package_order_id',$this->member_package_order_id);
        $this->list_session = $MemberPackageOrderSession->get()->toArray();
        //dd($this->list_session);
    }
    public function updateList(){
        $MemberPackageOrderSession = MemberPackageOrderSession::where('member_package_order_id',$this->member_package_order_id);
        $this->list_session = $MemberPackageOrderSession->get()->toArray();
    }
    public function doCancelSchedule($id){


        $MemberPackageOrderSession = MemberPackageOrderSession::find($id)->delete();
        
        $this->updateList();
    }
    public function doChangeSchedule($id){

        //$MemberPackageOrderSession = MemberPackageOrderSession::find($id);

        $this->dispatch('showModalChangeSchedule',['member_package_order_session_id'=>$id]);
    }
    public function render()
    {
        return view('livewire.order-activated-session-list');
    }
}
