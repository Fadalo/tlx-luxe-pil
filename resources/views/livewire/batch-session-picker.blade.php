<div>
    @if($showContent['showList'] == true)
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <button class="btn btn-info rounded-0 mt-3 mb-3" style="float:right" wire:click='doShowAddSession'>Add Session</button>
    <table class="table table-striped table-bordered">
        <thead>
                <tr>
                    <th width="5%"  style="text-align:center">No</th>
                    <th width="15%"  style="text-align:center">Session</th>
                    <th width="20%"  style="text-align:center">Instructor</th>
                    <th width="50%"  style="text-align:center">Schedule</th>
                    <th width="10%"  style="text-align:center">Action</th>
                </tr>
        </thead>
        <tbody>
          
            @foreach($listSession as $key => $value)
            <?php 
              //dd($value) 
               $oI = new App\Models\Instructor\Instructor;
               $Instructor = $oI->find($value['instructor_id']);
               $InstructorName = $Instructor->first_name .' '.$Instructor->last_name;

            ?>
            <tr>
                <td  style="text-align:center">{{$loop->iteration}}</td>
                <td  style="text-align:center">{{$value['name']}}</td>
                <td  style="text-align:center">{{$InstructorName}}</td>
                
                <td style="text-align:right">{{date('F,l d-Y [ H:i A',strtotime($value['start_datetime']))}} {{date('- H:i A ]',strtotime($value['end_datetime']))}}</td>
                <td>@include('PanelAdmin.component.action_session_grid.view')</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @elseif($showContent['showAdd'] == true)
   
         @include('PanelAdmin.Batch.Component.Tab.view-session-add')
   
    @elseif($showContent['showChangeInstructor'] == true)
  
         @include('PanelAdmin.Batch.Component.Tab.view-session-add')
    @endif
</div>
