<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;

class PackageOrderPaymentHistory extends Component
{
    public $config = [];
    public $member_id = '';
    public $data = [];
    public function mount(){
        $this->data = MemberPackageOrder::where('member_id',$this->member_id)
        ->where('status_payment','paid')->get()->toArray();

    }
    public function updateList(){
        $this->data = MemberPackageOrder::where('member_id',$this->member_id)
        ->where('status_payment','paid')->get()->toArray();
    }
    public function render()
    {
        return view('livewire.package-order-payment-history');
    }
}
