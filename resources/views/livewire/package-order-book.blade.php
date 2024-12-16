<div wire:poll.1000ms="updateList" class="row">
   @foreach($this->data as $key => $value)
    <div class="col-md-6">
        <div class="card  text-white-50" style="background-color: rgb(124 105 70) !important;">
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

                        $helper = new App\Helpers\H1BHelper;
                        $LastUpdate = $helper->lastUpdated($value['updated_at']);
                      // $LastUpdate = $value['updated_at'];
                        ?></h5>
                        <p class="card-text">Book At [ {{date('d-m-Y',strtotime($value['created_at']))}} ]<br>Total Ticket {{$value['qty_ticket_available']}}<br>Status - {{$helper->status_payment($value['status_payment'])}}</p>
                        <p class="card-text "><small class=" text-white"><br>Last updated {{$LastUpdate}}</small></p>
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
window.addEventListener('swal:payment', event => {
        
   
    var data = event.detail[0].member;
    var package = event.detail[0].package;
    var packageVariant = event.detail[0].packageVariant;
    //console.log(data);
    $('#order_id').val(data.id);
    $('#order_no').val(data.order_id);
    $('#package_id').val(package.name+'-'+packageVariant.name);
    $('#modalPayment').modal('show');
           console.log(event.detail[0]); 
          
});

</script>