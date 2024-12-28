<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrderSession;
use App\Models\Member\MemberPackageOrder;
use App\Models\Batch\BatchSession;
use Illuminate\Support\Facades\Auth;

class OrderActivatedSessionChangeSchedule extends Component
{
    public $config = [];
    public $selected = [];
    public $selectAll  = true;
    public $member_package_order_id = '';
    public $member_package_order_session_id = '';
    public $meta = [
        'session_id' => ['type'=> 'list_changeschedule' ,'width'=>'col-12', 'related_table'=>'App\Models\Batch\BatchSession','related_value'=>'name', 'label' => 'Session', 'default' => ''],
    ];
    public $items =[]; 
    public function mount()
    {
        //dd($this->member_package_order_id);
        $MemberPackageOrder = MemberPackageOrder::find($this->member_package_order_id);
        $MemberPackageOrderSession = MemberPackageOrderSession::select('batch_session_id')->where('member_package_order_id',$this->member_package_order_id)->get()->toArray();
       
        $bookId = [];
        foreach($MemberPackageOrderSession as $key => $value){
            $bookId[] = $value['batch_session_id'];
        }

        $BatchSession = BatchSession::where('batch_id',$MemberPackageOrder->batch_id)
        ->whereNotIn('id',$bookId);
       
        $this->items = $BatchSession->get()->toArray();

    }
    public function updateList(){

        $MemberPackageOrder = MemberPackageOrder::find($this->member_package_order_id);
        $MemberPackageOrderSession = MemberPackageOrderSession::select('batch_session_id')->where('member_package_order_id',$this->member_package_order_id)->get()->toArray();
       
        $bookId = [];
        foreach($MemberPackageOrderSession as $key => $value){
            $bookId[] = $value['batch_session_id'];
        }
      // dd($bookId);
        $BatchSession = BatchSession::where('batch_id',$MemberPackageOrder->batch_id)
        ->whereNotIn('id',$bookId);
       
        $this->items = $BatchSession->get()->toArray();
        
    }
    
    public function triggerAlert($msg,$title='Success!',$icon='success',)
    {
        // Emit event to frontend to trigger SweetAlert
        $this->dispatch('swal:alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $msg,
        ]);
    }
    public function saveChecked()
    {
        // Save or process the checked items
       
       
       if ($this->selected !== ''){
        $MemberPackageOrderSession = MemberPackageOrderSession::find($this->member_package_order_session_id);
        $MemberPackageOrderSession->batch_session_id  = $this->selected;
        $MemberPackageOrderSession->save();
       }
       //$this-> updateList();
       $this->triggerAlert( 'Berhasil Ubah Jadwal','Berhasil di Ubah Jadwal !!!','success');
       $this->dispatch('showModalDetail',['member_package_order_id'=>$this->member_package_order_id]);
 
    }
    
    public function render()
    {
        return view('livewire.order-activated-session-change-schedule');
    }
}
