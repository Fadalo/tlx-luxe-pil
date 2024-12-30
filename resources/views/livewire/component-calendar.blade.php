<div>

<div class="cal-header">
    <a href="#" wire:click='doPrev'
    >Prev</a>
    <h4 class="cal-title text-center text-uppercase font-700 font-15 bg-theme color-theme">TODAY SCHEDULE [ {{ date('F Y', strtotime($year . '-' . $month . '-01')) }} ]</h4>
    <a href="#" wire:click='doNext'> Next</a>
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