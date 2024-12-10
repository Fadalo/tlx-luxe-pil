<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;

class PackageOrderAvailable extends Component
{
    public $config = [];
    public $member_id = '';
    public $data = [];
    public function mount()
    {
        $memberPackageOrderObj = MemberPackageOrder::where('member_id',$this->member_id);
        $this->data = $memberPackageOrderObj->where('status_package','available')->get()->toArray();
    }
    public function updateList()
    {
        $memberPackageOrderObj = MemberPackageOrder::where('member_id',$this->member_id);
        $this->data = $memberPackageOrderObj->where('status_package','available')->get()->toArray();
    }
    public function render()
    {
        return view('livewire.package-order-available');
    }
}
