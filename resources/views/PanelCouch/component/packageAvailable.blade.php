
<div class="content">
      
    <?php
   
    //$value = (array)($value);
   // dd($value[1]);
    $list = [];
    foreach($value as $k => $v1){
        $list[$k] = $v1;
    }
    print_r($list);
   // exit();
   
    $oPv = new App\Models\Package\PackageVariant;
    $PackageVariant = $oPv::find($list['package_variant_id']);
   
    $oP = new App\Models\Package\Package;
    $Package = $oP::find($PackageVariant->package_id);
    
    $helper = new App\Helpers\H1BHelper;
    $LastUpdate = $helper->lastUpdated($value['updated_at']);
    ?>
    <h3 class="font-600"># {{$list['order_id']}}</h3>
    <p class="font-14  color-highlight">{{$Package->name.' '.$PackageVariant->name}}<br>Available Since [ {{date('d-M-Y',strtotime($list['available_package_started_datetime']))}} ]
        <br>Duration {{ 45*$list['qty_ticket_available'] }} days
        <br>Auto Actived In 7 Days
        <br>Total Ticket {{$list['qty_ticket_available']}}
    </p>
  
  
    <div class="float-start">
        <p class="font-10 opacity-80 mb-n1"><i class="far fa-calendar"></i> Last updated {{$LastUpdate}} </p>
        <p class="font-10 opacity-80"><i class="fa fa-map-marker-alt"></i> LUXE-PILATES</p>
    </div>
    <a href="{{route('member.listPackage')}}#" class="float-end btn btn-s bg-highlight rounded-s shadow-xl text-uppercase font-900 font-11 mt-2">Activated</a>
</div>