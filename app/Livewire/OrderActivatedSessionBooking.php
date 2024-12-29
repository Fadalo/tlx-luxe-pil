<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrderSession;
use App\Models\Member\MemberPackageOrder;
use App\Models\Batch\BatchSession;

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
        //dd($this->member_package_order_id);
        $MemberPackageOrder = MemberPackageOrder::find($this->member_package_order_id);
        $MemberPackageOrderSession = MemberPackageOrderSession::select('batch_session_id')->where('member_package_order_id',$this->member_package_order_id)->get()->toArray();
       // dd($MemberPackageOrderSession);
        $bookId = [];
        foreach($MemberPackageOrderSession as $key => $value){
            $bookId[] = $value['batch_session_id'];
        }
      // dd($bookId);
        $BatchSession = BatchSession::where('batch_id',$MemberPackageOrder->batch_id)
        ->whereNotIn('id',$bookId);
       
        $this->items = $BatchSession->get()->toArray();

    }
    public function updateList(){

        $MemberPackageOrder = MemberPackageOrder::find($this->member_package_order_id);
        $MemberPackageOrderSession = MemberPackageOrderSession::select('batch_session_id')->where('member_package_order_id',$this->member_package_order_id)->get()->toArray();
       // dd($MemberPackageOrderSession);
        $bookId = [];
        foreach($MemberPackageOrderSession as $key => $value){
            $bookId[] = $value['batch_session_id'];
        }
      // dd($bookId);
        $BatchSession = BatchSession::where('batch_id',$MemberPackageOrder->batch_id)
        ->whereNotIn('id',$bookId);
       
        $this->items = $BatchSession->get()->toArray();
        
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
    public function doAddSession($value){

        if (!Auth::check()) {
            return redirect('/login-new');
        }
        //dd($value);
        $MemberPackageOrderSession = new MemberPackageOrderSession;
        $MemberPackageOrderSession->member_package_order_id  = $this->member_package_order_id;
        $MemberPackageOrderSession->batch_session_id = $value['id'];
        $MemberPackageOrderSession->status_session = 'book';
        $MemberPackageOrderSession->qty_ticket_used = 1;
        $MemberPackageOrderSession->created_by = Auth::User()->id;
        $MemberPackageOrderSession->updated_by = Auth::User()->id;
        $MemberPackageOrderSession->save();
        $this->dispatch('showModalDetail',['member_package_order_id'=>$this->member_package_order_id]);
 
    }
    public function render()
    {
        return view('livewire.order-activated-session-booking');
    }
}
