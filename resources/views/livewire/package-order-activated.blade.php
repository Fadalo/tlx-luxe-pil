<div class="row"  >
    @if($view['viewGrid'] == true)
    
    @foreach($data as $key => $value)
    <div class="col-md-6">
        <div class="card bg-primary text-white-50">
            <div class="row no-gutters align-items-center">

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">[#{{$value['order_id']}}]<br> <?php 
                            $oPv = new App\Models\Package\PackageVariant; 
                            $oP = new App\Models\Package\Package; 
                            
                            $l= $oPv->find($value['package_variant_id']);
                            $g=$oP->find($l->package_id);
                            $packageVariantName = $g->name .' '. $l->name;
                            echo $packageVariantName;

                            $duration = 45*$value['qty_ticket_available'];
                            
                            $helper = new App\Helpers\H1BHelper;
                            $LastUpdate = $helper->lastUpdated($value['updated_at']);

                          
                            $endDate = date('Y-m-d H:i:s')
                            ?></h5>
                        <span class="card-text">Start At [ {{date('d-M-Y',strtotime($value['activated_package_started_datetime']))}} ]
                            <br>Expired In {{$value['activated_package_due_date']}} days
                            <br>Used Ticket {{$value['qty_ticket_used']}}/{{$value['qty_ticket_available']}}</span>
                        <p class="card-text "><small class=" text-white"><br>Last updated <br>{{ $LastUpdate }}</small></p>
                        <p>

                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="height:200px">
                        <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                           <livewire:PackageOrderActivatedGrid :id="$value['id']" :member_package_order_id="$value['id']">
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="display:none">

                </div>
                <div class="col-md-12 ">
                    &nbsp;
                </div>
                <div class="col-md-12 " style="display:none">



                    <div style="width:100%;overflow-x:scroll;overflow-y:hidden;">
                        <div class="p-3" style="width:max-content; ">
                            @for($j=1;$j<=10;$j++) <div style="display:inline-block;">
                                <div class="card bg-info  ms-1 mb-1 p-1">
                                    <div class="card-body">
                                        <div class="card-title text-white ">Session {{ $j }}</div>
                                        <div class="card-text">BOOKING DATE 19-09-2024</div>
                                        <div class="card-text">BOOKING TIME 18:00 WIB</div>

                                        <div class="card-text">BOOK BY: RIDWAN</div>
                                    </div>
                                </div>

                        </div>

                        @endfor
                    </div>
                </div>
            </div>

        </div>
</div>
</div>
@endforeach

@elseif($view['viewDetail'] == true)
<?php
   // dd($member_package_order_id);
    $MemberPackageOrder =  App\Models\Member\MemberPackageOrder::find($member_package_order_id);
    //dd($MemberPackageOrder);
?>
    @if($MemberPackageOrder)
    <div class="col-md-12">
        <div class="row">
            <div class="col-12">
                <button wire:click="doListBack()" class="btn btn-info rounded-0 mb-3" style="float:left">Back</button>
                <div style="float:right">
                <a style="color:white">Activated [# {{$MemberPackageOrder->order_id }}]</a> > <a style="color:white">Session :</a>&nbsp; > Detail 
                </div>
            </div>
            <div class="col-md-12">
                <livewire:OrderActivatedSessionList :config="$config" :member_package_order_id="$member_package_order_id"  />
            </div>
        </div>
    </div>

        
    @else
    
    @endif
@elseif($view['viewBooking'] == true)
<?php
    //dd($member_package_order_id);
    $MemberPackageOrder =  App\Models\Member\MemberPackageOrder::find($member_package_order_id);
    //dd($MemberPackageOrder);
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-12">
            <button wire:click="doListBack()" class="btn btn-info rounded-0 mb-3" style="float:left">Back</button>
            <div style="float:right">
            <a style="color:white">Activated [# {{$MemberPackageOrder->order_id }}]</a> > <a style="color:white">Session</a>&nbsp;  > Booking
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <livewire:OrderActivatedSessionBooking :config="$config" :member_package_order_id="$member_package_order_id" />
    </div>
</div>
@elseif($view['viewChangeSchedule'] == true)
<?php
    //dd($member_package_order_id);
    $MemberPackageOrder =  App\Models\Member\MemberPackageOrder::find($member_package_order_id);
    $MemberPackageOrderSession = App\Models\Member\MemberPackageOrderSession::find($member_package_order_session_id);
    $BatchSession = App\Models\Batch\BatchSession::find($MemberPackageOrderSession->batch_session_id);
    //dd($MemberPackageOrder);
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-12">
            <button wire:click="doListBack()" class="btn btn-info rounded-0 mb-3" style="float:left">Back</button>
            <div style="float:right">
            <a style="color:white">Activated [# {{$MemberPackageOrder->order_id }}]</a> > <a style="color:white">{{$BatchSession->name}}</a>&nbsp;  > Change Schedule
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <livewire:OrderActivatedSessionChangeSchedule :config="$config" :member_package_order_id="$member_package_order_id" />
    </div>
</div>
@endif

</div>