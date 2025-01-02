<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;
use Illuminate\Support\Facades\DB;


class DashboardChartCircle extends Component
{
    public $totalLastWeek = 0;
    public $totalLastMonth = 0;
    public $totalThisMonth = 0;
    public $totalOrder = 0;
    public $selectedMonth = '';
    public $selectedYear = '';
    public $month = [];
    public $year = [];
    public function mount()
    {
        $this->month = $this->doGetMonth();
        $this->year  = $this->doGetYear();
    }
    public function doGetYear(){
        $MemberPackageOrder = MemberPackageOrder::select(DB::raw('DATE_FORMAT(created_at, "%Y") as year'))
        ->groupBy('year')
        ->get()->toArray();
    
       // dd($MemberPackageOrder);
       return $MemberPackageOrder;
    }
    public function doGetMonth(){
       $MemberPackageOrder = MemberPackageOrder::select(DB::raw('DATE_FORMAT(created_at, "%M") as month'))
        ->groupBy('month')
        ->get()->toArray();
    
       // dd($MemberPackageOrder);
       return $MemberPackageOrder;

    }
    public function render()
    {
        return view('livewire.dashboard-chart-circle');
    }
}
