<div class="row">
    <div class="card">
        <div class="card-body">
          
            <table class="table table-striped" > 
                <thead>
                    <tr>
                        <th>Group</th>
                        <th>Variant</th>
                        
                        <th>Qty Ticket</th>
                        <th>Qty Used On Booking</th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                        
                        
                        $oP = new App\Models\Package\Package;
                        $package = $oP->get();
                        if ($package){
                            
                            $package = $package->toArray();
                       
                    ?>
                    @foreach($package as $key =>$val)
                           
                    <tr>
                        <td colspan="4">{{$val['name']}}</td>
                         
                        
                    </tr>
                    <?php
                            $oPV = new App\Models\Package\PackageVariant;
                            $packageV = $oPV->where('package_id','=',$val['id'])->get();
                            if ($packageV){
                            
                            $packageV = $packageV->toArray();
                            
                    ?>
                     @foreach($packageV as $key2 =>$val2)
                           
                     <tr>
                         <td >&nbsp;</td>
                         <td >{{$val2['name']}}</td>
                         <td >{{$val2['package_qty_ticket']}}</td>
                         <td >{{$val2['package_qty_used_book']}}</td>
                     </tr>
                     @endforeach
                     <?php } ?>
                    @endforeach
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>