<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 
use App\Models\Member\Member;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\MemberPackageOrderPayment;
use App\Models\Batch\Batch;
use App\Models\Package\Package;
use App\Models\Package\PackageVariant;

class PDFController extends Controller
{
    //
    public function viewPDF()
    {
        $data = ['title' => 'My First PDF'];
        $pdf = Pdf::loadView('pdf_view', $data);

        return $pdf->stream('sample.pdf');
    }
    public function viewInvoice($id){
        $memberPackageOrder = MemberPackageOrder::find($id);
        $member = Member::find($memberPackageOrder->member_id);
        $memberPackageOrderPayment = MemberPackageOrderPayment::find($memberPackageOrder->payment_id);
        $packageVariant = PackageVariant::find($memberPackageOrder->package_variant_id);
        $package = Package::find($packageVariant->package_id);
        $batch = Batch::find($memberPackageOrder->batch_id);

        $data =['data'=> [
            'title' => 'INVOICE_'.$memberPackageOrder->order_id,
            'member_name' => $member->first_name.' '.$member->last_name,
            'member_phone_no' => $member->phone_no,
            'order_id' => '#'.$memberPackageOrder->order_id,
            'order_date' => date('F d-Y',strtotime($memberPackageOrder->created_at)),
            'payment_date' => date('d-M-Y',strtotime($memberPackageOrderPayment->create_at)),
            'package_name' => $batch->name,
            'batch_name' => $batch->name,
            'payment_method' => $memberPackageOrderPayment->payment_method,
            'item_package' => $packageVariant->name.' ('.$memberPackageOrder->qty_ticket_available.')',
            'item_package_pay_qty' => 1,
            'item_package_pay_amount' => $memberPackageOrderPayment->amount,
            'item_package_pay_subtotal' => $memberPackageOrderPayment->amount,
            'item_package_pay_total' => $memberPackageOrderPayment->amount,
        ]];
        $pdf = Pdf::loadView('pdf_view', $data);

        return $pdf->stream('invoice_#'.$memberPackageOrder->order_id.'.pdf');
    }
}
