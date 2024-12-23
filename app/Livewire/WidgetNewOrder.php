<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\Member;
use Carbon\Carbon;

class WidgetNewOrder extends Component
{
    public $width = 'col-md-4';
    public $totalNewOrder = '0 orders';
    public $percentage = '0.00 %';
    public function mount(){
        $this->doCountTotalNewOrder();
        $this->doCountPercentage();
    }
    public function doCountTotalNewOrder(){

        $dStart = date('Y-m-1');
        $dEnd =  date("Y-m-t");

        $totalNewOrderThisMonth = MemberPackageOrder::where('created_at','>=', $dStart)
        ->where('created_at','<=', $dEnd)->count();
        
        $this->totalNewOrder =  $totalNewOrderThisMonth .' orders';
    }
    public function doCountPercentage(){
        $prevMonthCount = MemberPackageOrder::where('created_at','<', Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->count();
        $totalCount = MemberPackageOrder::All()->count();
        $percentage = (($totalCount-$prevMonthCount)/$totalCount)*100;
        $this->percentage =  $percentage .' %';
    }
    public function render()
    {
        return view('livewire.widget-new-order');
    }
}
