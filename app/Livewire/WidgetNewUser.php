<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\Member;
use Carbon\Carbon;

class WidgetNewUser extends Component
{

    public $width = 'col-md-4';
    public $totalUsers = '0 members';
    public $percentage = '0.00 %';
    public function mount(){
        $this->doCountTotalUsers();
        $this->doCountPercentage();

    }
    public function doCountTotalUsers(){

        $prevMonthCount = Member::where('created_at','<',Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->count();
        $totalCount = Member::All()->count();
        $this->totalUsers = ($totalCount-$prevMonthCount).' members';
    }
    public function doCountPercentage(){
        
        $prevMonthCount = Member::where('created_at','<',Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->count();
        $totalCount = Member::All()->count();
        $percentageMember = (($totalCount-$prevMonthCount)/$totalCount)*100;
        $this->percentage = $percentageMember.' %';
    }
    public function render()
    {
        return view('livewire.widget-new-user');
    }
}
