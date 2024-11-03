<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;
use App\Models\Batch\Batch;


class PackageOrderBook extends Component
{
    public $member_id;
    public $config;

    public $data;
    public function mount(){
        $this->data = MemberPackageOrder::where('member_id', $this->member_id)
        ->where('status_package','book')->get()->toArray();  
    }
    public function updateList(){
        $this->data = MemberPackageOrder::where('member_id', $this->member_id)
        ->where('status_package','book')->get()->toArray();
    }
    public function deleteList($id){
        $memberOrder = MemberPackageOrder::find($id);
        $batch = Batch::find($memberOrder->batch_id);

        // Update BatchQty
        $batch->qty_book = $batch->qty_book - 1;
        $batch->save();

        // Delete MemberOrder
        $memberOrder->delete();
        
        // Update Data & Alert
        $this->data = MemberPackageOrder::where('member_id', $this->member_id)
        ->where('status_package','book')->get()->toArray();
        $this->triggerAlert('Berhasil Hapus','Success!','success');
    }
    public function payment($id){

        $memberOrder = MemberPackageOrder::find($id);
        $this->dispatch('swal:payment', [
            'icon' => 'success',
            'title' => 'payment',
            'text' => 'payment text',
            'member'=> $memberOrder
        ]);
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
        return view('livewire.package-order-book');
    }
}
