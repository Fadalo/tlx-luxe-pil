<div>
    <div class="calendar bg-theme shadow-xl rounded-m">

        <div class="cal-header">
            <h4 class="cal-title text-center text-uppercase font-700 font-15 bg-theme color-theme">DETAIL SESSION #OD 0001</h4>

        </div>
        <div class="clearfix"></div>
        <div class="divider mb-1"></div>
        <div class="cal-footer">
            @foreach($events as $key => $value)
            <div class="cal-schedule">
                <em>{{date('H:i A',strtotime($value['start_datetime']))}}<br>{{date('H:i
                    A',strtotime($value['end_datetime']))}}</em>
                <strong>{{$value['batch_name']}}{{$value['name']}}</strong>
                <span><i class="fa-solid fa-cube"></i>PRIVATE - SINGLE</span>
                <div style="
                position: relative;
                margin-bottom: 60px;
            ">
                <a href="#" class="float-end btn btn-s bg-highlight rounded-s shadow-xl text-uppercase font-900 font-11 mt-2" style="margin-right:5px">Delete</a>
                
                <a href="#" class="float-end btn btn-s bg-highlight rounded-s shadow-xl text-uppercase font-900 font-11 mt-2" style="margin-right:3px">Change Schedule</a>
               </div>
            </div>
            @endforeach
        </div>
    </div>
</div>