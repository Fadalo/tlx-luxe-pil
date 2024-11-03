<div wire:poll.1000ms="updateList" class="row">
   @foreach($this->data as $key => $value)
    <div class="col-md-6">
        <div class="card  text-white-50" style="background-color: rgb(124 105 70) !important;">
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
                        <p class="card-text">Book At [ {{date('d-m-Y',strtotime($value['created_at']))}} ]<br>Total Ticket {{$value['qty_ticket_available']}}<br>Status - {{$value['status_payment']}}</p>
                        <p class="card-text "><small class=" text-white">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                <div style="height:200px">
                    <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                        <button wire:click="payment({{$value['id']}})"  data="{{$value['id']}}" class="btn btn-success rounded-0">Payment</button>&nbsp;
                        <button wire:click="deleteList({{$value['id']}})"  data="{{$value['id']}}" class="ml-3 btn btn-info rounded-0">Cancel</button>
                    
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
   
</div>
<script>

</script>