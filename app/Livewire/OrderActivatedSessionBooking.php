<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrderSession;
use App\Models\Member\MemberPackageOrder;
use App\Models\Batch\BatchSession;
use App\Models\Batch\Batch;
use App\Models\Package\PackageVariant;
use Illuminate\Support\Facades\Auth;

class OrderActivatedSessionBooking extends Component
{
    public $config = [];
    public $selected = [];
    public $selectAll  = true;
    public $member_package_order_id = '';
    public $meta = [
        'session_id' => ['type'=> 'checklist_booking' ,'width'=>'col-12', 'related_table'=>'App\Models\Batch\BatchSession','related_value'=>'name', 'label' => 'Session', 'default' => ''],
    ];
    public $items =[]; 
    
    public function mount()
    {
        $this->updateList();

    }
    /*
    //dd($this->member_package_order_id);
        $MemberPackageOrder = MemberPackageOrder::find($this->member_package_order_id);
        $MemberPackageOrderSession = [];
        if ($MemberPackageOrder){
            $MemberPackageOrderSession = MemberPackageOrderSession::select('batch_session_id')
            ->where('member_package_order_id',$this->member_package_order_id)
            ->get()->toArray();
      
        }
        // dd($MemberPackageOrderSession);
        $bookId = [];
        foreach($MemberPackageOrderSession as $key => $value){
            $bookId[] = $value['batch_session_id'];
        }
      // dd($bookId);
        $BatchSession = BatchSession::where('batch_id',$MemberPackageOrder->batch_id)
        ->whereNotIn('id',$bookId);
       
        $this->items = $BatchSession->get()->toArray();
    */
    public function updateList(){

        $MemberPackageOrder = MemberPackageOrder::find($this->member_package_order_id);
        if ($MemberPackageOrder){
            $MemberPackageOrderSession = MemberPackageOrderSession::select('batch_session_id')
               ->where('member_package_order_id',$this->member_package_order_id)->get()->toArray();
            // dd($MemberPackageOrderSession);
             $bookId = [];
             foreach($MemberPackageOrderSession as $key => $value){
                  $bookId[] = $value['batch_session_id'];
             }
             // dd($bookId);
              $BatchSession = BatchSession::where('batch_id',$MemberPackageOrder->batch_id)
              ->where('start_datetime','>=',date('Y-m-d 00:00:00'))
               ->whereNotIn('id',$bookId);
       
             $this->items = $BatchSession->get()->toArray();
        }
        
        
    }
    public function doCheckAll()
    {
        

        if($this->selectAll == true){
            
           foreach($this->items as $key =>$value){
                $this->selected[$key] =$value['id'];
           }
           $this->selectAll = false; 
        }
        else{
            $this->selected = [];
            $this->selectAll = true;
        }
       
        
    }
    
    public function getChecked()
    {
        // This method can be used to retrieve the selected items
        return array_filter($this->items, fn($item) => in_array($item['id'], $this->selected));
    }

    public function saveChecked()
    {
        // Save or process the checked items
        //dd($this->selected);
        //dd($selectedItems);
        $selectedItems = $this->getChecked();
        
        foreach($selectedItems as $key => $value)
        {
            $this->doAddSession($value);
        }
        // Debugging or further processing
    }
    public function doCheckQtyMax($key,$id){
      //  dd($key);
       
        $BatchSession =  BatchSession::find($id);
        if($BatchSession){
            $Batch = Batch::find($BatchSession->batch_id);
            if ($Batch){
                if ( $BatchSession->qty_reserved >= $Batch->qty_max){
                    unset($this->selected[$key]);
                    $this->triggerAlert('Qty Already Max 8','Error !!!','error');
                }
            }
        }
    }
    public function triggerAlert($msg,$title='Success!',$icon='success')
    {
        // Emit event to frontend to trigger SweetAlert
        $this->dispatch('swal:alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $msg,
        ]);
    }
    public function doAddSession($value){

        if (!Auth::check()) {
            return redirect('/login-new');
        }
        //dd($value);
        $BatchSession =  BatchSession::find($value['id']);

        if($BatchSession){
            $Batch = Batch::find($BatchSession->batch_id);
            if ($Batch){
                if ( $BatchSession->qty_reserved < $Batch->qty_max){
                    $MemberPackageOrder = MemberPackageOrder::find($this->member_package_order_id);
                    if($MemberPackageOrder){
                        $packageVariant = PackageVariant::find($MemberPackageOrder->package_variant_id);
                        if($packageVariant ){
                            $MemberPackageOrderSession = new MemberPackageOrderSession;
                            $MemberPackageOrderSession->member_package_order_id  = $this->member_package_order_id;
                            $MemberPackageOrderSession->batch_session_id = $value['id'];
                            $MemberPackageOrderSession->status_session = 'book';
                            $MemberPackageOrderSession->qty_ticket_used = $packageVariant->package_qty_used_book;
                            $MemberPackageOrderSession->created_by = Auth::User()->id;
                            $MemberPackageOrderSession->updated_by = Auth::User()->id;
                            $MemberPackageOrderSession->save();
                    
                            $MemberPackageOrder->qty_ticket_used = $MemberPackageOrder->qty_ticket_used +   $packageVariant->package_qty_used_book;
                            $MemberPackageOrder->save();
                            
                            $BatchSession->qty_reserved =  $BatchSession->qty_reserved  +  $packageVariant->package_qty_used_book;
                            $BatchSession->save();
                    
                            $this->dispatch('showModalDetail',['member_package_order_id'=>$this->member_package_order_id]);
                        }
                       
                    }
                 
                }
                
            }
           
        }
       
 
    }
    public function render()
    {
        return view('livewire.order-activated-session-booking');
    }
}
