<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\Member;
use App\Models\Package\Package;
use App\Models\Package\PackageVariant;
use App\Models\Member\MemberPackageOrder;

class WidgetLastMemberPackageOrder extends Component
{
    public $width ='col-md-8';
    public $head = [
        'No',
        'Member Name',
        'Phone No',
        //'Status',
        'Qty',
        'Action'
    ];
    public $data = [];
    public function mount(){
        
        $this->data =  $this->getList();

       // dd($data);
    }
   
    public function update(){
        $this->data =  $this->getList();
    }
    public function getList(){
    

        $MemberPackageOrder = MemberPackageOrder::join('member', 'member_package_order.member_id', '=', 'member.id')
        ->selectRaw("
        member.id as id,
        CONCAT(member.first_name, ' ', member.last_name) as name,
        member.phone_no ,
       
        sum(member_package_order.qty_ticket_available - member_package_order.qty_ticket_used) as qty
        ")
        
        ->groupBy('id')
        ->groupBy('name')
        ->groupBy('phone_no')
        ->whereIn('status_package',['activated','available'])
        ->limit(100)
        ->orderBy('qty','desc')
        ->get();

        return $MemberPackageOrder;
    }
    public function render()
    {
        return view('livewire.widget-last-member-package-order');
    }
}
