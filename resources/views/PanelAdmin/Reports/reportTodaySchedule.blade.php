<div class="row">
    <div class="card">
        <div class="card-body">
          
            <table class="table table-striped" > 
                <thead>
                    <tr>
                        <th>Batch</th>
                        <th>Instructor</th>
                        <th>Session Name</th>
                        
                        <th>Schedule</th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                        
                        $BatchSession = BatchSession::join('batch','batch.id','=','batch_session.batch_id')
                        ->where('batch_session.instructor_id',$this->instructor_id)
                        ->where('status_session','running')
                        ->whereRaw('DATE(`batch_session`.`start_datetime`) = DATE(\''.$date.'\')')
                        ->selectRaw('
                            batch_session.*,
                            batch.name as batch_name,
                            batch.start_datetime as batch_start_datetime,
                            batch.end_datetime as batch_end_datetime
                            
                            
                            
                        ')
                        ->get()->toArray();
                        
                    ?>
                    @foreach($dataOrder as $keyOrder =>$valOrder)
                    <?php
                        $om = new App\Model\Member\Member;
                        $member = $om->where('member_id',$valOrder['member_id']);

                    ?>
                    <tr>
                        <td>{{$valOrder['order_id']}}</td>
                        <td>{{$valOrder['']}}</td>
                        <td>{{$valOrder['']}}</td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>