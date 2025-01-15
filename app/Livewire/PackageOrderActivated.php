<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderSession;

class PackageOrderActivated extends Component
{
    public $config = [];
    public $member_id = '';
    public $member_package_order_id = '';
    public $member_package_order_session_id = '';
    
    public $data = [];
    public $view = [
        'viewGrid'=>true,
        'viewBooking' => false,
        'viewDetail' => false,
        'viewChangeSchedule' => false,
    ];
    protected $listeners = [
    'btnSaveBookingSession',
    'showDetailView',
    'showModalBooking',
    'showModalDetail',
    'showModalChangeSchedule'];


    
    public function mount(){
        $this->data  = MemberPackageOrder::where('member_id',$this->member_id)
        ->where('status_package','activated')
        ->orderBy('activated_package_started_datetime','asc')
        ->get()->toArray();
    }
    public function updateList()
    {
        $memberPackageOrderObj = MemberPackageOrder::where('member_id',$this->member_id);
        $this->data = $memberPackageOrderObj->where('status_package','activated')->orderBy('activated_package_started_datetime','asc')->get()->toArray();
    }
    public function showModalBooking($param){
       // dd($param['member_package_order_id']);
        $this->member_package_order_id = $param['member_package_order_id'];
        //$this->update();
        //dd($this->member_package_order_id);
        $this->view = [
            'viewGrid'=>false,
            'viewBooking' => true,
            'viewDetail' => false,
            'viewChangeSchedule' => false
        ];
    }
    public function showModalDetail($param){
        $this->member_package_order_id = $param['member_package_order_id'];
        $this->view = [
            'viewGrid'=>false,
            'viewBooking' => false,
            'viewDetail' => true,
            'viewChangeSchedule' => false
        ];
    }
    public function showModalChangeSchedule($param){
        $this->member_package_order_session_id = $param['member_package_order_session_id'];
        $this->view = [
            'viewGrid'=>false,
            'viewBooking' => false,
            'viewDetail' => false,
            'viewChangeSchedule' => true
        ];
    }
    public function doListBack(){
        $this->view = [
            'viewGrid'=>true,
            'viewBooking' => false,
            'viewDetail' => false,
            'viewChangeSchedule' => false
        ];
    }
    public function btnSaveBookingSession($id){
        dd($id);
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
            'viewGrid'=>false,
            'viewActivated' => false,
            'viewBooking' => false,
            'viewDetail' => false,
            'viewDetail' => true,
            'viewChangeSchedule' => false
        ];
    }
    public function showActivatedView()
    {
        $this->view = [
            'viewGrid'=>false,
            'viewActivated' => true,
            'viewBooking' => false,
            'viewDetail' => false,
            'viewChangeSchedule' => false
        ];
    }
    public function render()
    {
        return view('livewire.package-order-activated');
    }
}
