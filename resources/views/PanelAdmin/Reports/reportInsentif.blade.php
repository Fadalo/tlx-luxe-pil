<div class="row">
    <div class="card">
        <div class="card-body">
          
            <table class="table table-striped" style="text-align: center" > 
              
                <tbody>
                    <?php 
                        
                        $dStartDate = $_GET['dStartDate'];
                        $dEndDate = $_GET['dEndDate'];
                        $instructor_id = $_GET['instructor_id'];
                        $timestamp = $_GET['timestamp'];

                        $oII = new App\Models\Instructor\InstructorInsentif;
                        
                        $list = $oII::join('instructor','instructor.id','=','instructor_insentif.instructor_id')
                        ->join('batch_session','instructor_insentif.session_id','=','batch_session.id')
                        ->join('batch','batch.id','=','batch_session.batch_id')
                        ->where('instructor_insentif.created_at','>=', $dStartDate)
                        ->where('instructor_insentif.created_at','<=', $dEndDate)
                        ->where('instructor_insentif.instructor_id','=',$instructor_id)
                        ->selectRaw(
                            '
                            concat(instructor.first_name," ",instructor.last_name) as instructor_name,
                            batch.name as batch_name,
                            batch_session.name as batch_session_name,
                            instructor_insentif.amount as insentif,
                            instructor_insentif.created_at as date_generated
                            '
                        )
                        ->get();
                        if ($list){
                            
                            $list = $list->toArray();
                       $bold='ss';
                    ?>
                    @foreach($list as $key =>$val)
                 
                    <?php
            
                    ?>
                    @if($bold != $val['batch_name'])
                   
                    <tr style="background-color: grey">
                      <td colspan="4"><h2>{{$val['batch_name']}}</h2></td>
                    </tr>
                    <tr>
                        <th>Instructor</th>
                        <th>Session Name</th>
                        <th>Insentif</th>
                        <th>Date Generated</th>
                    </tr>
                    <?php $bold = $val['batch_name'] ;?>
                    @endif
                    <tr>
                        <td>{{$val['instructor_name']}}</td>
                      
                        <td>{{$val['batch_session_name']}}</td>
                        <td>{{$val['insentif']}}</td>
                        <td >{{date('F ,d-Y',strtotime($val['date_generated']))}}</td>
                        
                    </tr>
                    @endforeach
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>