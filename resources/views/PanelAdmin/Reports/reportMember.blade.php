<div class="row">
    <div class="card">
        <div class="card-body">
          
            <table class="table table-striped" style="text-align: center" > 
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        
                        <th>Phone No</th>
                        <th>Birthday</th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                        
                        $dStartDate = $_GET['dStartDate'];
                        $dEndDate = $_GET['dEndDate'];
                        $timestamp = $_GET['timestamp'];

                        $oI = new App\Models\Member\Member;
                        $list = $oI->where('created_at','>=', $dStartDate)
                        ->where('created_at','<=', $dEndDate)
                        ->get();
                        if ($list){
                            
                            $list = $list->toArray();
                       
                    ?>
                    @foreach($list as $key =>$val)
                 
                    <tr>
                        <td>{{$val['first_name']}}</td>
                        <td>{{$val['last_name']}}</td>
                       
                        <td>{{$val['phone_no']}}</td>
                        <td >{{date('F ,d-Y',strtotime($val['birthday']))}}</td>
                        
                    </tr>
                    @endforeach
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>