<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Package\PackageVariant;
use App\Models\Batch\Batch;
use App\Models\Member\MemberPackageOrder;

use Illuminate\Support\Facades\Auth;


class PackageOrderCreate extends Component
{
    public $config;
    public $member_id;
    public $package_variant_id ='';
    public $select = [];
    public $data = [];
    public function mount(){

        $this->select = PackageVariant::all()->toArray();
        $this->data = [];
    }
    public function onChangeSelect($id){
        //print_r($id);
        //exit();
        $PackObj = PackageVariant::find($id);
       // print_r($PackObj);
       // exit();
       $this->data = [];
       $this->data = Batch::where('package_id',$PackObj->package_id)->get();
    }
    public function updateList(){
        $PackObj = PackageVariant::find($this->package_variant_id);
        $this->data = Batch::where('package_id',$PackObj->package_id)->get();
    }
    public function onBook($id){

       //print_r($this->member_id);
       //exit();
        $BatchObj = Batch::find($id);
        if ($BatchObj->qty_book < $BatchObj->qty_max){
        $PackObj = PackageVariant::find($this->package_variant_id);
        $param = [
            'member_id' => $this->member_id,
            'package_variant_id' => $this->package_variant_id,
            'batch_id' => $id,
            'qty_ticket_available' => $PackObj->package_qty_ticket,
            'status_package' => 'book',
            'status_payment' => 'not_paid',
            'is_member_created' => 0,
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
        ];
        
       // $this->triggerAlert( '','Berhasil di booking !!!','success');
        $result = MemberPackageOrder::create($param);
       
        $result->order_id = 'OD '.(100000+$result->id);
        $result->save();
        $BatchObj->qty_book = $BatchObj->qty_book + 1;
        $BatchObj->save();
        $this->data = Batch::where('package_id',$PackObj->package_id)->get();
        
        $this->triggerAlert( 'Berhasil Booking','Berhasil di booking !!!','success');
        }

    }
    public function triggerAlert($msg,$title='Success!',$icon='success',)
    {
        // Emit event to frontend to trigger SweetAlert
        $this->dispatch('swal:alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $msg,
        ]);
    }
    public function render()
    {
        return view('livewire.package-order-create');
    }
}
