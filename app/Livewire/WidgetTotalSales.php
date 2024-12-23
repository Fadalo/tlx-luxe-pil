<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrderPayment;
use App\Models\Member\Member;
use Carbon\Carbon;
class WidgetTotalSales extends Component
{

    public $config = [];
    public $width = 'col-md-4';
    public $totalSales = 'Rp. 0.00';
    public $percentage = '0.00 %';
    public function mount(){
        $this->doCountTotalSales();
        $this->doCountPercentageCompareLastMonth();
    }
    public function doCountTotalSales(){
        $totalAmount=0;
        $totalAmountPrev =0;
        $MemberPackageOrderPayment = new MemberPackageOrderPayment();
        $listPayment = $MemberPackageOrderPayment->get();
        //dd($listPayment);
        foreach($listPayment as $key => $value){
            $amount = $this->getValueCurrency($value['amount']);
          //  print_r($amount);
            $totalAmount = $totalAmount + $amount;
        }

        $prevMonthCount = MemberPackageOrderPayment::where('created_at','<',Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->get();
        foreach($prevMonthCount as $key => $value){
            $amountPrev = $this->getValueCurrency($value['amount']);
          //  print_r($amount);
            $totalAmountPrev = $totalAmountPrev + $amountPrev;
        }


        $this->totalSales = 'Rp. '.number_format($totalAmount - $totalAmountPrev, 2, '.', ',');
    }
    public function doCountPercentageCompareLastMonth(){

        $this->percentage = '0.00 %';
    }
    public function formatCurrency($amount){

    }
    public function getValueCurrency($currencyString)
    {
        $currencyString = $currencyString;

        // Remove the currency symbol and commas
        $numericValue = preg_replace('/[^\d.]/', '', $currencyString);

        // Convert to float
        $floatValue = (float)$numericValue;

        return $floatValue; // Output: 2000000
    }
    public function render()
    {
        return view('livewire.widget-total-sales');
    }
}
