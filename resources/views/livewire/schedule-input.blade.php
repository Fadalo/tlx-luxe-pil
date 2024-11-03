<div>
    <form wire:submit.prevent="submit">
        @foreach ($schedules as $weekIndex => $week)
            <div class="week-section mb-4">
                <h6>Week {{ $weekIndex + 1 }}</h6>

                @foreach ($week['days'] as $dayIndex => $day)
                    <div class="day-section mb-3">
                        <input type="text" 
                               wire:model="schedules.{{ $weekIndex }}.days.{{ $dayIndex }}.name" 
                               placeholder="Day Name (e.g., Monday)" 
                               class="form-control mb-2">

                        @foreach ($day['time_ranges'] as $rangeIndex => $timeRange)
                            <div class="time-range-section d-flex mb-2">
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

                        <button type="button" class="btn btn-secondary rounded-0" 
                                wire:click="addTimeRange({{ $weekIndex }}, {{ $dayIndex }})">
                            Add Time Range
                        </button>
                    </div>
                @endforeach

                <button type="button" class="btn btn-secondary rounded-0" 
                        wire:click="addDay({{ $weekIndex }})">
                    Add Day
                </button>
            </div>
        @endforeach

        <button type="button" class="btn btn-primary rounded-0" wire:click="addWeek">
            Add Week
        </button>

        <button type="submit" class="btn btn-success rounded-0 ">Submit</button>
    </form>
</div>
