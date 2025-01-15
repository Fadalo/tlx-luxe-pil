<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;
use App\Models\Package\PackageVariant;
use App\Models\Package\Package;


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
    public function doActivation($id)
    {
        $MemberPackageOrder = MemberPackageOrder::find($id);
        if ($MemberPackageOrder){
            $PackageVariants = PackageVariant::find($MemberPackageOrder->package_variant_id);
            if($PackageVariants){
                $MemberPackageOrder->activated_package_started_datetime = now();
               // $MemberPackageOrder->activated_package_due_date = (45*$MemberPackageOrder->qty_ticket_available);
                $MemberPackageOrder->activated_package_due_date = ($PackageVariants->package_max_days);
                $MemberPackageOrder->status_package = 'activated';
                //$MemberPackageOrder->updated_at = now();
                $MemberPackageOrder->save();
            }
        }
       
        
    }
    public function render()
    {
        return view('livewire.package-order-available');
    }
}
