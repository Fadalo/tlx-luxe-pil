<div class="card bg-primary text-white-50">
    <div class="row no-gutters align-items-center">

        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$Batch['name']}} </h5>
                <p>Session Name : {{$oBS['name']}}<br>Package Name : {{$Package->name}}</p>
                <p>{{date('F, l d-m-Y [ H:i A -',strtotime($oBS['start_datetime']))}} {{date(' H:i A ]',strtotime($oBS['end_datetime']))}} </p>
            </div>
        </div>
        <div class="col-md-4">
            <div style="height:200px">
                <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                        <button class="btn btn-info rounded-0" wire:click='doAbsenInstructor({{$oBS['id']}})' type="button"
                           >
                            Absen 
                        </button>
                </div>
            </div>
        </div>
    </div>
</div>