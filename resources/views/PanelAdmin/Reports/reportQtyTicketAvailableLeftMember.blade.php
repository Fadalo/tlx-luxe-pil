<div class="row">
    <div class="card">
        <div class="card-body">
          
            <table class="table table-striped" style="text-align: center">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Phone No</th>
                        <th>Qty</th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                      $dStartDate = $_GET['dStartDate'];
                      $dEndDate = $_GET['dEndDate'];
                      
                      $oMPO = new App\Models\Member\MemberPackageOrder;
                      $list = $oMPO->join('member', 'member_package_order.member_id', '=', 'member.id')
                        ->selectRaw("
                        member.id as id,
                        CONCAT(member.first_name, ' ', member.last_name) as name,
                        member.phone_no ,
                    
                        sum(member_package_order.qty_ticket_available - member_package_order.qty_ticket_used) as qty
                        ")
                        
                        ->groupBy('id')
                        ->groupBy('name')
                        ->groupBy('phone_no')
                        ->where('member_package_order.created_at','>=',$dStartDate)
                        ->where('member_package_order.created_at','<=',$dEndDate)
                        ->whereIn('status_package',['activated','available'])
                        ->limit(100)
                        ->orderBy('qty','desc')
                        ->get();
                    
                       if ($list){
                           $list = $list->toArray();
                      
                    ?>
                    @foreach($list as $keyOrder =>$valOrder)
                   
                    <tr>
                        <td>{{$valOrder['name']}}</td>
                        <td>{{$valOrder['phone_no']}}</td>
                        <td>{{$valOrder['qty']}}</td>
                    </tr>
                    @endforeach
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>