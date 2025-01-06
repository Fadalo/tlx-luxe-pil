<div>
    <form wire:submit.prevent="submit">
        @foreach ($schedules as $weekIndex => $week)
            <div class="col-12 week-section mb-4">
                

                @foreach ($week['days'] as $dayIndex => $day)
                    <div class="day-section mb-3">
                       
                        <select  wire:model="schedules.{{ $weekIndex }}.days.{{ $dayIndex }}.name"  class="form-select mb-2" >
                            @foreach($list_weekday as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                        @foreach ($day['time_ranges'] as $rangeIndex => $timeRange)
                            <div class="time-range-section d-flex mb-2">
                                
                                <select wire:model="schedules.{{ $weekIndex }}.days.{{ $dayIndex }}.time_ranges.{{ $rangeIndex }}.theme" class="form-control me-2">
                                    <option>-- select theme --</option>
                                    <option>Thema 1</option>
                                    <option>Thema 2</option>
                                </select>
                                <input type="time" 
                                       wire:model="schedules.{{ $weekIndex }}.days.{{ $dayIndex }}.time_ranges.{{ $rangeIndex }}.start" 
                                       class="form-control me-2">

                                <input type="time" 
                                       wire:model="schedules.{{ $weekIndex }}.days.{{ $dayIndex }}.time_ranges.{{ $rangeIndex }}.end" 
                                       class="form-control me-2">

                                <button type="button" class="btn btn-danger rounded-0" 
                                        wire:click="removeTimeRange({{ $weekIndex }}, {{ $dayIndex }}, {{ $rangeIndex }})">
                                    Remove
                                </button>
                            </div>
                        @endforeach

                        <button type="button" class="btn btn-primary rounded-0" 
                                wire:click="addTimeRange({{ $weekIndex }}, {{ $dayIndex }})">
                            Add Time Range
                        </button>
                        <button type="button" class="btn btn-warning rounded-0" 
                        wire:click="addDay({{ $weekIndex }})">
                    Add Day
                </button>
                        <button type="button" class="btn btn-danger rounded-0" 
                            wire:click="removeDay({{ $weekIndex }}, {{ $dayIndex }})">
                        Remove Day
                        </button>
                    </div>
                @endforeach

               
            </div>
        @endforeach

       

        <button type="submit" class="btn btn-info rounded-0 ">Submit</button>
    </form>
</div>
