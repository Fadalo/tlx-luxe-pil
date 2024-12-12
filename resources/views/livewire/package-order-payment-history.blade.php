

<div wire:poll.1000ms="updateList" class="table-responsiv">
             <table  class="table table-dark dt-table mb-0">

                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Invoice No</th>
                         <th>Status</th>
                         <th>Paid By</th>
                         <th>Date</th>
                         <th>Package</th>
                         <th>Action</th>
                         
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($data as $key => $value)
                   
                     <tr>
                         <th scope="row">{{$loop->iteration}}</th>
                         <td>#{{$value['order_id']}}</td>
                         <td>{{strtoupper($value['status_payment'])}}</td>
                         <?php
                            $oPv = new App\Models\Package\PackageVariant; 
                            $oP = new App\Models\Package\Package; 
                            $oPayment =   new App\Models\Member\MemberPackageOrderPayment; 
                       
                            $payment = $oPayment->find($value['payment_id']);  
                            $packageVariant = $oPv->find($value['package_variant_id']);
                            $package = $oP->find($packageVariant['package_id']);

                         ?>
                         <td>{{ $payment->payment_type}} - {{$payment->amount}}</td>
                         <td>{{date('d-M-Y',strtotime($payment->created_at))}}</td>
                         <td>{{$package->name}} - {{$packageVariant->name}}</td>
                         <td><a target="_blank" href="{{ route('invoice', ['id' => $value['id']]) }}" class="btn btn-primary">Print</a></td>
                     </tr>
                   @endforeach
                 </tbody>
             </table>
         </div>