<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Package\PackageVariant;
use App\Models\Batch\Batch;
use App\Models\Member\MemberPackageOrder;
use App\Models\Instructor\Instructor;

use Illuminate\Support\Facades\Auth;


class PackageOrderCreate extends Component
{
    public $config;
    public $member_id;
    public $selectInstructor = [];
    public $instructor_id = '';
    public $package_variant_id ='';
    public $select = [];
    public $data = [];
    public $dStartDate = '';
    public $dEndDate = '';
    
    public function mount(){

        $this->select = PackageVariant::all()->toArray();
        $this->selectInstructor = Instructor::get()->toArray();
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
    public function doSearch(){
        $id = $this->package_variant_id;
        $instructor_id = $this->instructor_id;
        $dStartDate = $this->dStartDate;
        $dEndDate = $this->dEndDate;
       
        $this->data = [];
       
        $this->data = Batch::join('package_variant','package_variant.package_id','=','batch.package_id');
        
        if ($id != ''){
                 $this->data = $this->data->where('package_variant.id',$id);
        }
        if ($instructor_id != ''){
            $this->data = $this->data->where('instructor_id',$instructor_id);
        }
       // ->where('package_variant.id',$id)
      // ->where('batch.start_datetime','>=',$dStartDate)
      //  ->where('batch.end_datetime','<=',$dEndDate)
      $this->data = $this->data->selectRaw(
            '
            batch.id as id,
            batch.instructor_id as instructor_id,
            concat(batch.name," - ",package_variant.name) as name,
            package_variant.id as package_variant_id,
            batch.start_datetime as start_datetime,
            batch.end_datetime as end_datetime,
            batch.qty_max as qty_max,
            batch.qty_book as qty_book

            '
        )
      //  ->orderBy('package_variant.package_qty_ticket','asc')
        ->orderBy('name','asc')
       
        
        ->get();
      
    }
    public function updateList(){
        $PackObj = PackageVariant::find($this->package_variant_id);
        $this->data = Batch::where('package_id',$PackObj->package_id)->get();
    }
    public function onBook($id,$package_variant_id){

        if (!Auth::check()) {
            return redirect('/login-new');
        }
       //print_r($this->member_id);
       //exit();
        $this->package_variant_id = $package_variant_id;
        $BatchObj = Batch::find($id);
       // if ($BatchObj->qty_book < $BatchObj->qty_max){
        $PackObj = PackageVariant::find($package_variant_id);
        $param = [
            'member_id' => $this->member_id,
            'package_variant_id' => $package_variant_id,
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
      //  }

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
