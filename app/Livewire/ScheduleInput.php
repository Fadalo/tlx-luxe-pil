<?php

namespace App\Livewire;

use Livewire\Component;

class ScheduleInput extends Component
{
    public $schedules = [];

    public function mount()
    {
        // Initialize with one week and one day
        $this->addWeek();
    }

    public function addWeek()
    {
        $this->schedules[] = [
            'days' => [
                ['name' => 'Monday', 'time_ranges' => [['start' => '', 'end' => '']]],
            ],
        ];
    }

    public function addDay($weekIndex)
    {
        $this->schedules[$weekIndex]['days'][] = [
            'name' => '',
            'time_ranges' => [['start' => '', 'end' => '']],
        ];
    }

    public function addTimeRange($weekIndex, $dayIndex)
    {
        $this->schedules[$weekIndex]['days'][$dayIndex]['time_ranges'][] = ['start' => '', 'end' => ''];
    }

    public function removeTimeRange($weekIndex, $dayIndex, $rangeIndex)
    {
        unset($this->schedules[$weekIndex]['days'][$dayIndex]['time_ranges'][$rangeIndex]);
    }

    public function render()
    {
        return view('livewire.schedule-input');
    }

    public function submit()
    {
        // Example: Save or process the schedule data
        dd($this->schedules);
    }
}
