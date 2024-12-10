<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;

class PackageOrderActivated extends Component
{
    public $config = [];
    public $member_id = '';
    public $data = [];
    public function mount(){
        $this->data  = MemberPackageOrder::where('member_id',$this->member_id)
        ->where('status_package','activated')
        ->get()->toArray();
    }
    public function updateList()
    {
        $memberPackageOrderObj = MemberPackageOrder::where('member_id',$this->member_id);
        $this->data = $memberPackageOrderObj->where('status_package','activated')->get()->toArray();
    }
    public function render()
    {
        return view('livewire.package-order-activated');
    }
}
