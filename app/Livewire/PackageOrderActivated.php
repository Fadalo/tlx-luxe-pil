<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderSession;

class PackageOrderActivated extends Component
{
    public $config = [];
    public $member_id = '';
    public $data = [];
    public $view = [
        'viewActivated' => true,
        'viewDetail' => false,
    ];
    protected $listeners = ['btnSaveBookingSession','showDetailView'];


    public $member_package_order_id ='';
    public function mount(){
        $this->data  = MemberPackageOrder::where('member_id',$this->member_id)
        ->where('status_package','activated')
        ->get()->toArray();
    }
    public function updateList()
    {
        $memberPackageOrderObj = MemberPackageOrder::where('member_id',$this->member_id);
        $this->data = $memberPackageOrderObj->where('status_package','activated')->get()->toArray();
    }
    public function btnSaveBookingSession($id){
        $session = new MemberPackageOrderSession;
        $MemberPackageOrder =  MemberPackageOrder::find($id);

        if ($MemberPackageOrder->qty_ticket_used <= $MemberPackageOrder->qty_ticket_available){
            $MemberPackageOrder->qty_ticket_used =  $MemberPackageOrder->qty_ticket_used + 1;
            $MemberPackageOrder->save();

            $session->member_package_order_id = $MemberPackageOrder->id;
            $session->session_date = '';
          //  $session->session_duration = '';
           // $session->qty_ticket_used = '';
          //  $session->qty_ticket_available = '';
            $session->status_session = 'book'; // book, running, cancel, burn
            $session->is_member_created = 0;
            $session->status_document = 'draft';
        }
        
     
    }
    public function showDetailView()
    {
        $this->view = [
            'viewActivated' => false,
            'viewDetail' => true,
        ];
    }
    public function showActivatedView()
    {
        $this->view = [
            'viewActivated' => true,
            'viewDetail' => false,
        ];
    }
    public function render()
    {
        return view('livewire.package-order-activated');
    }
}