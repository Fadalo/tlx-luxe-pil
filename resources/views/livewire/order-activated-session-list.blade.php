<div  >
    {{-- The best athlete wants his opponent at his best. --}}
    <table class="table table-striped">
        <tr>
            <td>No</td> 
            <td>Session</td>
            <td>Schedule</td>
            <td>Action</td>
        </tr>
    @foreach($list_session as $key => $value)
    <?php
        $session = new App\Models\Batch\BatchSession;
        $listSession = $session->find($value['batch_session_id']);
    ?>
        <tr>
            <td>{{$loop->iteration}}</td> 
            <td>{{ $listSession['name']}}</td>
            <td>{{ date('F ,d Y  [ H:i - ',strtotime($listSession['start_datetime'])).date('H:i ] ',strtotime($listSession['end_datetime']))}}</td>
            <td><div class="btn-group">
                
                <button class="btn btn-info rounded-0  dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Action <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" wire:click='doChangeSchedule({{ $value['id']}})'>Change Schedule</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" wire:click='doCancelSchedule({{ $value['id']}})'>Cancel Schedule</a>
                </div>
            </div></td>
        </tr>
    @endforeach
    </table>
</div>
