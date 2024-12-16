<div wire:poll.1000ms="updateList" class="row">
    @foreach($this->data as $key => $value)
    <div class="col-md-6">
        <div class="card bg-info text-white-50">
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
                            ?></h5>
                        <p class="card-text">Available Since [ {{date('d-M-Y',strtotime($value['available_package_started_datetime']))}} ]
                            <br>Duration {{ $duration }} days<br>Auto Actived In {{$value['available_package_due_date']}} Days
                            <br>Total Ticket {{$value['qty_ticket_available']}}</p>
                        <p class="card-text "><small class=" text-white">Last updated <br>{{ $LastUpdate }}</small></p>
                    </div>
                    
                </div>
                <div class="col-md-4">
                <div style="height:200px">
                    <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                        <button wire:click='doActivation({{$value['id']}})'class="btn btn-success rounded-0">Activated</button>
                    </div>
                   
                    </div>
                </div>
                <img style="position:absolute;top:80px;right:0px;width:150px;" src="{{env('BASE_ADMIN_URL')}}/images/paid.png"  />
            </div>
        </div>
    </div>
    @endforeach
   
</div>
