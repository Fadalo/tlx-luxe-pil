<div class="row">
    
    @foreach($data as $key => $value)
    <div class="col-md-6">
        <div class="card bg-dark ">
            <div class="row no-gutters align-items-center">

                <div class="col-md-8">
                    
                    <div class="card-body">

                        <h5 class="card-title text-black">[#{{$value['order_id']}}]<br> <?php 
                        $oPv = new App\Models\Package\PackageVariant; 
                        $oP = new App\Models\Package\Package; 
                        
                        $l= $oPv->find($value['package_variant_id']);
                        $g=$oP->find($l->package_id);
                        $packageVariantName = $g->name .' '. $l->name;
                        echo $packageVariantName;
                        $helper = new App\Helpers\H1BHelper;
                        $LastUpdate = $helper->lastUpdated($value['updated_at']);
                        ?></h5>
                        
                        <p class="card-text">Expired At [ {{date('d-M-Y',strtotime($value['updated_at']))}} ]<br>Used Ticket {{$value['qty_ticket_available']}}/{{$value['qty_ticket_available']}}</span></p>
                        <p class="card-text "><small >Last updated {{$LastUpdate}}</small></p>
                       
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    @endforeach
   
</div>