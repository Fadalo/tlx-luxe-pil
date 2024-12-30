<div class="card card-style">
    <div class="content">
        <h3 class="font-600">Your Next Session Schedule</h3>
        <p class="font-11 mt-n2 color-highlight">{{$value['batch_name']}}- {{$value['name']}}</p>
        
        <div class="float-start">
            <p class="font-10 opacity-80 mb-n1"><i class="far fa-calendar"></i> {{date('F d-Y',strtotime($value['start_datetime']))}}<i class="ms-4 far fa-clock"></i>{{date('H:i A',strtotime($value['start_datetime']))}}</p>
            <p class="font-10 opacity-80"><i class="fa fa-map-marker-alt"></i> LUXE PILATES</p>
        </div>
        
    </div>
</div>