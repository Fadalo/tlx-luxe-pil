<div class="col-md-12">
    <a  wire:click='doShowList' class="btn btn-info rounded-0">Back</a>
    <span style="float: right;">CHANGE INSTRUCTOR > {{ $session_name_pick }}<span>
</div>
<br>
<div class="col-md-12">

    <div class="card" style="border:1px solid">
        <div class="card-body">
        <input wire:click='doShowExists' type="radio" name="type" checked="true"  > Exist</input>
        <input wire:click='doShowNew' type="radio" name="type" > New Temporary Instructor</input>
        </div>
    </div>
    <div class="card" style="border:1px solid">
        <div class="card-body">
            @if($selectedType['exits'] == true)
                <livewire:ScheduleChangeInstructorExits :batch_session_id="$batch_session_id" />
            @elseif($selectedType['new'] == true)
                <livewire:ScheduleChangeInstructorNew :batch_session_id="$batch_session_id"/>
            @endif
           
        </div>
    </div>
   
</div>