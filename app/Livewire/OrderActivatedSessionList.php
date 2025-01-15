<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrderSession;
use App\Models\Member\MemberPackageOrder;
use App\Models\Batch\BatchSession;



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


        $MemberPackageOrderSession = MemberPackageOrderSession::find($id);
        if($MemberPackageOrderSession){
            $MemberPackageOrder = MemberPackageOrder::find( $MemberPackageOrderSession->member_package_order_id);
            if($MemberPackageOrder){
                $BatchSession = BatchSession::find($MemberPackageOrderSession->batch_session_id);
                if($BatchSession){
                    $BatchSession->qty_reserved = $BatchSession->qty_reserved - $MemberPackageOrderSession->qty_ticket_used;
                    $BatchSession->save();

                    $MemberPackageOrder->qty_ticket_used =  $MemberPackageOrder->qty_ticket_used - $MemberPackageOrderSession->qty_ticket_used;
                    $MemberPackageOrder->save();
    
                    $MemberPackageOrderSession->delete();
                }
              
            }
          
        }
      
        
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
