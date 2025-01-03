<div class="row">
    <div class="card">
        <div class="card-body">
          
            <table class="table table-striped" style="text-align: center" > 
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Batch  - Session Name</th>
                        <th>Schedule</th>
                        <th>Absen Status</th>
                        <th>Absen On</th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                        $dStartDate = $_GET['dStartDate'];
                        $dEndDate = $_GET['dEndDate'];
                        $member_id = $_GET['member_id'];
                        
                        $oMPOS = new App\Models\Member\MemberPackageOrderSession;
                        $listSession = $oMPOS
                        ->join('member_package_order','member_package_order.id','=','member_package_order_session.member_package_order_id')
                        ->join('member','member_package_order.member_id','=','member.id')
                        ->join('batch_session','member_package_order_session.batch_session_id','=','batch_session.id')
                        ->join('batch','batch.id','=','batch_session.batch_id')
                        
                        ->where('member.id','=',$member_id )
                        ->where('member_package_order_session.datetime_absen','>=',$dStartDate )
                        ->where('member_package_order_session.datetime_absen','<=',$dEndDate )
                        ->selectRaw(
                            '
                        concat(member.first_name," ",member.last_name) as member_name,
                        concat(batch.name,"-",batch_session.name) as BatchSessionName,
                        batch_session.start_datetime as start_datetime,
                        batch_session.end_datetime as end_datetime,
                        member_package_order_session.is_absen as is_absen,
                        member_package_order_session.datetime_absen as datetime_absen
                        
                        
                            '
                        )
                        ->get();
                        if ($listSession){

                            $listSession =  $listSession->toArray();
                    ?>
                    @foreach($listSession as $keyOrder =>$valOrder)
                  
                    <tr>
                        <td>{{$valOrder['member_name']}}</td>
                        <td>{{$valOrder['BatchSessionName']}}</td>
                        <td>{{date('F, l d-Y [H:i A -',strtotime($valOrder['start_datetime']))}} {{date('H:i A]',strtotime($valOrder['end_datetime']))}}</td>
                        <td>{{ ($valOrder['is_absen']==1)?'Absen':''}}</td>
                        <td>{{date('F, l d-Y H:i A',strtotime($valOrder['datetime_absen']))}}</td>
                        
                    </tr>
                    @endforeach
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>