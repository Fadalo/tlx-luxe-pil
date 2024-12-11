<div class="row">
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
                            $targetTime = '';
                            $helper = new App\Helpers\H1BHelper;
                            $LastUpdate = $helper->lastUpdated($value['updated_at']);
                            
                            ?></h5>
                        <span class="card-text">Start At [ {{date('d-M-Y',strtotime($value['activated_package_started_datetime']))}} ]<br><livewire:CountdownTimer :prefix="'Expired In:'" :format="'days'"  :targetTime="'2025-02-01 18:00:00'" :id="$value['id']"/><livewire:CountdownTimer :prefix="'Auto Actived In'" :id="'dd'" :format="'days'" :targetTime="'2024-11-01 18:00:00'"/><br>Used Ticket {{$value['qty_ticket_used']}}/{{$value['qty_ticket_available']}}</span>
                        <p class="card-text "><small class=" text-white">Last updated {{ $LastUpdate }}</small></p>
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
</div>