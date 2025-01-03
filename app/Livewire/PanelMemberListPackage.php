<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;

class PanelMemberListPackage extends Component
{
    public $showTab = [
        'tabAvailable' => true,
        'tabActivated' => false,
        'tabExpired' => false,
    ];
    public $listAvailable = [];
    public $listActivated = [];
    public $listExpired = [];
    public $member_id = '';

    public function mount(){
        $this->showActivated();
    }
    public function doActivated($id){

        $MemberPackageOrder = MemberPackageOrder::find($id);
        $MemberPackageOrder->activated_package_started_datetime = now();
        $MemberPackageOrder->activated_package_due_date = (45*$MemberPackageOrder->qty_ticket_available);
        $MemberPackageOrder->status_package = 'activated';
        $MemberPackageOrder->save();
        $this->showActivated();
        
    }
    public function showAvailable(){
       // dd('ss');
       // exit();
        $member_id = $this->member_id;
        $MemberPackageOrder = MemberPackageOrder::where('member_id',$member_id)
        ->where('status_package','available')->get()->toArray();
        $this->listAvailable =  $MemberPackageOrder;
        $this->showTab =  [
            'tabAvailable' => true,
            'tabActivated' => false,
            'tabExpired' => false,
        ];
    }
    public function showActivated(){
        $member_id = $this->member_id;
        $MemberPackageOrder = MemberPackageOrder::where('member_id',$member_id)
        ->where('status_package','activated')->get()->toArray();
        $this->listActivated =  $MemberPackageOrder;
        $this->showTab =  [
            'tabAvailable' => false,
            'tabActivated' => true,
            'tabExpired' => false,
        ];
    }
    public function showExpired(){
        $member_id = $this->member_id;
        $MemberPackageOrder = MemberPackageOrder::where('member_id',$member_id)
        ->where('status_package','expired')->get()->toArray();
        $this->listExpired =  $MemberPackageOrder;
        $this->showTab =  [
            'tabAvailable' => false,
            'tabActivated' => false,
            'tabExpired' => true,
        ];
    }
    public function render()
    {
        return view('livewire.panel-member-list-package');
    }
}
