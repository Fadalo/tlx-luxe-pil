<div wire:poll.1000ms="updateList" class="row">
    @foreach($this->data as $key => $value)
    <div class="col-md-6">
        <div class="card bg-info text-white-50">
            <div class="row no-gutters align-items-center">

                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">[#OD {{ '10000'.$value['id']}}]<br> <?php 
                        $oPv = new App\Models\Package\PackageVariant; 
                        $oP = new App\Models\Package\Package; 
                        
                        $l= $oPv->find($value['package_variant_id']);
                        $g=$oP->find($l->package_id);
                        $packageVariantName = $g->name .' '. $l->name;
                        echo $packageVariantName;
                        ?></h5>
                        <p class="card-text">Available Since [ 19/09/2024 ]<br>Duration 450 days<br>Auto Actived In 7 Days<br>Total Ticket {{$value['qty_ticket_available']}}</p>
                        <p class="card-text "><small class=" text-white">Last updated 3 mins ago</small></p>
                    </div>
                    
                </div>
                <div class="col-md-4">
                <div style="height:200px">
                    <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                        <button class="btn btn-success rounded-0">Activated</button>
                    </div>
                   
                    </div>
                </div>
                <img style="position:absolute;top:80px;right:0px;width:150px;" src="{{env('BASE_ADMIN_URL')}}/images/paid.png"  />
            </div>
        </div>
    </div>
    @endforeach
   
</div>