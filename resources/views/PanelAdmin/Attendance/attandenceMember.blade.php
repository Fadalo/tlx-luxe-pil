<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <h5 class="card-header">Member Information</h5>
            <div class="card-body">

                <table>
                    <tr>
                        <td width="40%">Name</td>
                        <td width="60%">: {{$Member->first_name}} {{$Member->last_name}} </td>
                    </tr>
                    <tr>
                        <td>Phone No</td>
                        <td>: {{$Member->phone_no}} </td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="card">
            <h5 class="card-header">PACKAGE</h5>
            <div class="card-body">
                <?php
                   $MemberPackageOrder =    $MemberPackageOrder->first();
                   $oPV = new App\Models\Package\PackageVariant;
                   $oP = new App\Models\Package\Package;

                   $PackageVariant = $oPV->find($MemberPackageOrder->package_variant_id);
                   $Package = $oP->find($PackageVariant->package_id);
                ?>
                <table>
                    <tr>
                        
                        <td width="100%">[#{{$MemberPackageOrder->order_id}}] <br> {{$Package->name}} {{$PackageVariant->name}} </td>
                    </tr>
                    <tr>
                        <td>Ticket Used: {{$MemberPackageOrder->qty_ticket_used}} / {{$MemberPackageOrder->qty_ticket_available}}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

    <div class="col-md-8">
        <?php 
         $listMPO =    $MemberPackageOrder->limit(1)->get();
        ?>
        @foreach($listMPO  as $key => $value)
        <?php 
        $oMPO = new App\Models\Member\MemberPackageOrderSession;
       
        $oB = new App\Models\Batch\Batch;
        $oBS = new App\Models\Batch\BatchSession;
        
        
        $listMPOS = $oMPO->where('member_package_order_id',$value['id'])
        ->where('status_session','book')
        ->limit(1)->get()->toArray();

        ?>
        @foreach($listMPOS as $kls => $vls)
        <?php
        
        $oBS = new App\Models\Batch\BatchSession;
        $BatchSession = $oBS->find($vls['batch_session_id']);

        if (date('Y-m-d H:i:s',strtotime($BatchSession->start_datetime)) < date('Y-m-d H:i:s',strtotime(now())) and date('Y-m-d H:i:s',strtotime(now())) < date('Y-m-d H:i:s',strtotime($BatchSession->end_datetime)) ){
        ?>
        <div class="card bg-primary text-white-50">
            <div class="row no-gutters align-items-center">

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">[#{{$value['order_id']}}]<br> Private Private - Single - {{($BatchSession['name'])}}</h5>
                        <span class="card-text">Start At [ {{date('d/m/Y H:i:s',strtotime($BatchSession['start_datetime']))}}]
                            <br>End At [ {{date('d/m/Y H:i:s',strtotime($BatchSession['end_datetime']))}}]
                            <br>Will Used {{ $vls['qty_ticket_used']}} Ticket</span>
                        <p>

                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="height:200px">
                        <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                            <a wire:click='doAbsenMember({{$vls['id']}})' class="btn btn-info rounded-0">ABSEN</a>

                        </div>
                    </div>
                </div>


            </div>

        </div>
        <?php } else{
           echo ' <div>Belum Ada Jadwal</div>';
        }?>
        @endforeach
        @endforeach
    </div>
</div>
</div>