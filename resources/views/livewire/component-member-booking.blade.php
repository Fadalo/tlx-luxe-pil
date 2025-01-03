<div>
<div class="calendar bg-theme shadow-xl rounded-m">

<div class="cal-header">
    <h4 class="cal-title text-center text-uppercase font-700 font-15 bg-theme color-theme">{{$month}} {{ date('F Y', strtotime($year . '-' . $month . '-01')) }}</h4>
    <h6 class="cal-title-left color-theme" wire:click='doPrev'><i class="fa fa-chevron-left" ></i></h6>
    <h6 class="cal-title-right color-theme" wire:click='doNext'><i class="fa fa-chevron-right" ></i></h6>
</div>
<div class="clearfix"></div>
<div class="divider mb-1"></div>
<div class="cal-days bg-theme opacity-80 pt-2 pb-2">
    
    <a href="#" class="color-highlight">SUN</a>
    <a href="#" class="color-highlight">MON</a>
    <a href="#" class="color-highlight">TUE</a>
    <a href="#" class="color-highlight">WED</a>
    <a href="#" class="color-highlight">THU</a>
    <a href="#" class="color-highlight">FRI</a>
    <a href="#" class="color-highlight">SAT</a>
    <div class="clearfix"></div>
</div>
<div class="divider mb-1"></div>
<div class="cal-dates cal-dates-border">
    @foreach ($calendar as $week)
   
        @foreach ($week as $day)
             <a href="#" wire:click="getEventsForDate('{{ $day['date'] }}')" class="{{$day['extraClass']}}">
                @if($day['event'] == true and $day['today'] == false)
                <i class="fa fa-circle " style="color:brown" aria-hidden="true"></i>
                @endif
               @if($day['today'] == true)
                 <i class="fa fa-square color-highlight"></i>
                 <span>{{ $day['day'] }}</span>
               @else
                 {{ $day['day'] }}
                 @endif
             </a>
        @endforeach
    
    @endforeach
    <div class="clearfix"></div>
</div>
</div>
<div class="calendar bg-theme shadow-xl rounded-m">

    <div class="cal-header">
        <h4 class="cal-title text-center text-uppercase font-700 font-15 bg-theme color-theme">DETAIL SESSION </h4>
       
    </div>
    <div class="clearfix"></div>
    <div class="divider mb-1"></div>
<div class="cal-footer">
    @foreach($events as $key => $value)
    <div class="cal-schedule">
        <em>{{date('H:i A',strtotime($value['start_datetime']))}}<br>{{date('H:i A',strtotime($value['end_datetime']))}}</em>
        <strong>{{$value['name']}}</strong>
        <span><i class="fa fa-building"></i>LUXE PILATES</span>
    </div>
    @endforeach
</div>
</div>
</div>