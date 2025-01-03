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
        
    </div>

    <div class="col-md-8">
        <?php
            $oMPOS = $MemberPackageOrderSession->first();
            if ($oMPOS)
            {

                $oMPOS =  $oMPOS->toArray();
              
        ?>
                <div class="card bg-primary text-white-50">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">[#{{$oMPOS['order_id']}}]<br> {{$oMPOS['package_name']}} - {{$oMPOS['package_variant_name']}} -
                                    {{($oMPOS['batch_session_name'])}}</h5>
                                <span class="card-text">Start At [ {{date('d/m/Y
                                    H:i:s',strtotime($oMPOS['start_datetime']))}}]
                                    <br>End At [ {{date('d/m/Y H:i:s',strtotime($oMPOS['end_datetime']))}}]
                                    <br>Will Used {{  $oMPOS['qty_ticket_used']}} Ticket</span>
                                <p>

                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="height:200px">
                                <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                                    <a wire:click='doAbsenMember({{$oMPOS['member_package_order_session_id']}})' class="btn btn-info rounded-0">ABSEN</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } else { ?>
            <div >Belum Ada Jadwal atau sudah absen</div>
        <?php } ?>

    </div>
</div>
</div>