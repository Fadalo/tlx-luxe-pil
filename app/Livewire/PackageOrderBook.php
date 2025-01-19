<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderPayment;
use App\Models\Package\Package;
use App\Models\Package\PackageVariant;
use App\Models\Batch\Batch;
use Illuminate\Support\Facades\Auth;


class PackageOrderBook extends Component
{
    public $member_id;
    public $config;

    public $data;
    protected $listeners = ['paymentSave'];
    public function mount(){
        $this->data = MemberPackageOrder::where('member_id', $this->member_id)
        ->where('status_package','book')->get()->toArray();  
    }
    public function updateList(){
        $this->data = MemberPackageOrder::where('member_id', $this->member_id)
        ->where('status_package','book')->get()->toArray();
    }
    public function deleteList($id){
        $memberOrder = MemberPackageOrder::find($id);
        $batch = Batch::find($memberOrder->batch_id);

        // Update BatchQty
        $batch->qty_book = $batch->qty_book - 1;
        $batch->save();

        // Delete MemberOrder
        $memberOrder->delete();
        
        // Update Data & Alert
        $this->data = MemberPackageOrder::where('member_id', $this->member_id)
        ->where('status_package','book')->get()->toArray();
        $this->triggerAlert('Berhasil Hapus','Success!','success');
    }
    public function convertVal($val){
        $currency = $val;

        // Remove 'Rp' and thousands separator
        $sanitized = str_replace(['Rp', '.'], '', $currency);

        // Replace decimal comma with dot
        $sanitized = str_replace(',', '.', $sanitized);

        // Convert to float
        $numericValue = (float)$sanitized;

        return $numericValue; // Output: 1234.56
    }
    public function paymentSave($param){
      // dd($param);
        if (!Auth::check()) {
            return redirect('/login-new');
        }
    
       if ( $this->convertVal($param['bank_amount']) == "0.00"){
        $this->triggerAlert('Please Check Required Input !!!',$title='error !!!',$icon='error');
       }else{

      
       $oPayment = new  MemberPackageOrderPayment;
       $oPayment->member_package_order_id = $param['order_id'];
       $oPayment->payment_type = $param['payment_type'];
       $oPayment->bank = $param['bank'];
       $oPayment->bank_account = $param['bank_account'];
       $oPayment->amount = $param['bank_amount'];
       $oPayment->created_by = Auth::User()->id;
       $oPayment->updated_by = Auth::User()->id;
       
       $oPayment->save();

       $MemberPackageOrder = MemberPackageOrder::find($param['order_id']);
       $MemberPackageOrder->status_package = "available";
       $MemberPackageOrder->status_payment = "paid";
       $MemberPackageOrder->payment_id =$oPayment->id;
       $MemberPackageOrder->available_package_started_datetime = now();
       $MemberPackageOrder->available_package_due_date = 7;
       $MemberPackageOrder->save();
       

       $this->dispatch('doClosePayment',['icon'=>'success','title'=>'Success !!!','text'=>'success save!!!']);
       }
    }
    public function payment($id){

        $memberOrder = MemberPackageOrder::find($id);
        if($memberOrder){
            $packageVariant = PackageVariant::find($memberOrder->package_variant_id);
         
            if($packageVariant){
                $package = Package::find($packageVariant->id);
                dd($packageVariant->id);
                if($package){
                    $this->dispatch('swal:payment', [
                        'icon' => 'success',
                        'title' => 'payment',
                        'text' => 'payment text',
                        'member'=> $memberOrder,
                        'packageVariant' => $packageVariant,
                        'package'=> $package,
                        'paymentType'=> ['cash','transfer'],
            
                    ]);
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
    public function render()
    {
        return view('livewire.package-order-book');
    }
}
