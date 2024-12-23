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
        'Status',
        'Qty',
        'Action'
    ];
    public $data = [];
    public function mount(){

        $MemberPackageOrder = MemberPackageOrder::limit(100)->get();

        $MemberPackageOrder = MemberPackageOrder::select('*') // Select all columns
        ->orderByRaw('(qty_ticket_available - qty_ticket_used) DESC') // Order by the calculated field
        ->limit(100) // Limit to 100 records
        ->get();


    }
   
    public function render()
    {
        return view('livewire.widget-last-member-package-order');
    }
}
